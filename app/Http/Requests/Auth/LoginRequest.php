<?php

namespace App\Http\Requests\Auth;

use App\Models\User;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => [
                'required',
                'string',
                'email',
            ],
            'password' => [
                'required',
                'string',
            ],
        ];
    }

    public function authenticate(): void
    {
        $this->ensureIsNotRateLimited();

        $email = $this->string('email')->toString();
        $password = $this->string('password')->toString();

        $routeName = $this->route()->getName();

        $user = User::where('email', $email)->first();

        if (
            !$user ||
            !Hash::check($password, $user->password)
        ) {
            RateLimiter::hit(
                $this->throttleKey()
            );

            throw ValidationException::withMessages([
                'email' => trans('auth.failed'),
            ]);
        }

        if ($routeName === 'appointments.login.store') {
            if (!$user->hasRole('patient')) {
                RateLimiter::hit(
                    $this->throttleKey()
                );

                throw ValidationException::withMessages([
                    'email' => 'This account does not have access to the Appointment Portal.',
                ]);
            }
        }

        if ($routeName === 'customer.login.store') {
            if (!$user->hasRole('customer')) {
                RateLimiter::hit(
                    $this->throttleKey()
                );

                throw ValidationException::withMessages([
                    'email' => 'This account does not have access to the Ordering Portal.',
                ]);
            }
        }

        if ($routeName === 'admin.login.store') {
            if (!$user->hasRole('admin')) {
                RateLimiter::hit(
                    $this->throttleKey()
                );

                throw ValidationException::withMessages([
                    'email' => 'Only administrators can log in here.',
                ]);
            }
        }

        if ($routeName === 'dentist.login.store') {
            if (!$user->hasRole('dentist')) {
                RateLimiter::hit(
                    $this->throttleKey()
                );

                throw ValidationException::withMessages([
                    'email' => 'Only dentist accounts can log in here.',
                ]);
            }
        }

        if ($routeName === 'receptionist.login.store') {
            if (!$user->hasRole('receptionist')) {
                RateLimiter::hit(
                    $this->throttleKey()
                );

                throw ValidationException::withMessages([
                    'email' => 'Only receptionist accounts can log in here.',
                ]);
            }
        }

        if ($routeName === 'pos.login.post') {
            if (!$user->hasRole('cashier')) {
                RateLimiter::hit(
                    $this->throttleKey()
                );

                throw ValidationException::withMessages([
                    'email' => 'Only cashier accounts can log in here.',
                ]);
            }
        }

        Auth::login(
            $user,
            $this->boolean('remember')
        );

        RateLimiter::clear(
            $this->throttleKey()
        );
    }

    public function ensureIsNotRateLimited(): void
    {
        if (
            !RateLimiter::tooManyAttempts(
                $this->throttleKey(),
                5
            )
        ) {
            return;
        }

        event(
            new Lockout($this)
        );

        $seconds = RateLimiter::availableIn(
            $this->throttleKey()
        );

        throw ValidationException::withMessages([
            'email' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    public function throttleKey(): string
    {
        return Str::transliterate(
            Str::lower(
                $this->string('email')->toString()
            )
            . '|'
            . $this->ip()
        );
    }
}
