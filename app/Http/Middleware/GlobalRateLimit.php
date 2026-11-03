<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Symfony\Component\HttpFoundation\Response;

class GlobalRateLimit
{
    public function handle(Request $request, Closure $next): Response
    {
        // Let the guest appointment flow use its dedicated route throttle.
        if (
            $request->is('guest-appointment-booking') ||
            $request->is('guest-appointment-booking/thank-you/*')
        ) {
            return $next($request);
        }

        $identity = $request->user()
            ? 'user:' . $request->user()->getAuthIdentifier()
            : 'ip:' . $request->ip();

        $key = 'global-http:' . hash('sha256', $identity);

        if (RateLimiter::tooManyAttempts($key, 180)) {
            $retryAfter = RateLimiter::availableIn($key);

            return response()->json([
                'message' => 'Too many requests. Please wait before trying again.',
            ], 429, ['Retry-After' => (string) $retryAfter]);
        }

        RateLimiter::hit($key, 60);

        return $next($request);
    }
}
