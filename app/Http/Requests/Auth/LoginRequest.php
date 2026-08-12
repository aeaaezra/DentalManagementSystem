<?php

namespace App\Http\Requests\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ];
    }

    /**
     * Attempt to authenticate the request's credentials.
     *
     * @throws ValidationException
     */
   public function authenticate(): void
{
    $this->ensureIsNotRateLimited();

    $credentials = [
        'email' => $this->email,
        'password' => $this->password,
    ];

    /*
    |--------------------------------------------------------------------------
    | Restrict login based on the login page
    |--------------------------------------------------------------------------
    */

    // Admin Login (/admin-login)
    if ($this->route()->getName() === 'admin.login.store') {
        $credentials['role'] = 'admin';
    }

    // POS Login (/pos/login)
    elseif ($this->route()->getName() === 'pos.login.post') {
        $credentials['role'] = 'cashier';
    }

    // Normal Login (/login)
    else {
        $credentials['role'] = ['patient', 'dentist', 'staff', 'cashier', 'customer'];
    }

    /*
    |--------------------------------------------------------------------------
    | Authenticate
    |--------------------------------------------------------------------------
    */

    if (
        isset($credentials['role']) &&
        is_array($credentials['role'])
    ) {

        $user = \App\Models\User::where('email', $credentials['email'])
            ->whereIn('role', $credentials['role'])
            ->first();

        if (
            ! $user ||
            ! \Illuminate\Support\Facades\Hash::check(
                $credentials['password'],
                $user->password
            )
        ) {

            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'email' => trans('auth.failed'),
            ]);
        }

        Auth::login($user, $this->boolean('remember'));

    } else {

        if (! Auth::attempt($credentials, $this->boolean('remember'))) {

            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'email' => trans('auth.failed'),
            ]);
        }
    }

    RateLimiter::clear($this->throttleKey());
}

    /**
     * Ensure the login request is not rate limited.
     *
     * @throws ValidationException
     */
    public function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the rate limiting throttle key for the request.
     */
    public function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->string('email')).'|'.$this->ip());
    }
}
