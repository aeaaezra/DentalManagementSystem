<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RequireTwoFactor
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        // No authenticated user.
        if (! $user) {
            return $next($request);
        }

        // Only require 2FA when it is actually enabled.
        if (
            $user->two_factor_enabled &&
            ! empty($user->google2fa_secret)
        ) {
            // Already passed 2FA during this session.
            if (session('2fa_verified') === true) {
                return $next($request);
            }

            // Remember which user needs to complete 2FA.
            session([
                '2fa_user_id' => $user->id,
                '2fa_login_type' => 'admin',
            ]);

            // Remove the normal authentication temporarily.
            Auth::logout();

            return redirect()->route('2fa.login');
        }

        return $next($request);
    }
}
