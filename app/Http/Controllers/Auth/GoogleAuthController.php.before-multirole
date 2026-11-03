<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Laravel\Socialite\Facades\Socialite;
use Spatie\Permission\Models\Role;
use Throwable;

class GoogleAuthController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
        } catch (Throwable $e) {
            report($e);

            return redirect()
                ->route('customer.login')
                ->withErrors([
                    'email' => 'Google sign-in failed. Please try again.',
                ]);
        }

        $email = strtolower(trim((string) $googleUser->getEmail()));

        if (
            $email === '' ||
            ! filter_var($email, FILTER_VALIDATE_EMAIL) ||
            ! $googleUser->getId()
        ) {
            return redirect()
                ->route('customer.login')
                ->withErrors([
                    'email' => 'Google did not provide a valid email address.',
                ]);
        }

        /*
         * Only accept verified Google email addresses.
         */
        if (($googleUser->user['email_verified'] ?? false) !== true) {
            return redirect()
                ->route('customer.login')
                ->withErrors([
                    'email' => 'Your Google email must be verified.',
                ]);
        }

        $user = User::whereRaw('LOWER(email) = ?', [$email])->first();

        if ($user) {
            /*
             * Never convert existing staff or other-role accounts.
             * Existing accounts must have exactly the customer role.
             */
            if (
                ! $user->hasRole('customer') ||
                $user->getRoleNames()->count() !== 1
            ) {
                return redirect()
                    ->route('customer.login')
                    ->withErrors([
                        'email' => 'This email belongs to an account that cannot sign in through customer Google login.',
                    ]);
            }
        } else {
            if (! Role::where('name', 'customer')
                ->where('guard_name', 'web')
                ->exists()) {
                report(new \RuntimeException(
                    'The customer role is missing for the web guard.'
                ));

                return redirect()
                    ->route('customer.login')
                    ->withErrors([
                        'email' => 'Customer registration is temporarily unavailable.',
                    ]);
            }

            $user = DB::transaction(function () use ($email, $googleUser) {
                $newUser = new User();
                $newUser->name = $googleUser->getName()
                    ?: $googleUser->getNickname()
                    ?: 'Customer';
                $newUser->email = $email;
                $newUser->role = 'customer';
                $newUser->password = bin2hex(random_bytes(32));
                $newUser->email_verified_at = now();
                $newUser->save();
                $newUser->assignRole('customer');

                return $newUser;
            });
        }

        Auth::login($user);
        request()->session()->regenerate();

        return redirect()->route('customer.products');
    }
}

