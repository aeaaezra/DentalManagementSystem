<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(
        Request $request,
        Closure $next,
        ...$roles
    ): Response {
        if (!Auth::check()) {
            if ($request->is('customer/*')) {
                return redirect()
                    ->route('customer.login')
                    ->with('error', 'Please log in to access the ordering system.');
            }

            if ($request->is('shine-and-smile/appointments/*')) {
                return redirect()
                    ->route('appointments.login')
                    ->with('error', 'Please log in to access the appointment system.');
            }

            return redirect()
                ->route('login')
                ->with('error', 'Please log in to access this page.');
        }

        $user = Auth::user();

        if (empty($roles)) {
            return $next($request);
        }

        $allowedRoles = array_map(
            fn ($role) => strtolower(trim($role)),
            $roles
        );

        foreach ($allowedRoles as $role) {
            if ($user->hasRole($role)) {
                return $next($request);
            }
        }

        $loginType = session('login_type');

        if ($loginType === 'appointment') {
            return redirect()
                ->route('appointments.homepage')
                ->with('error', 'You do not have access to that page.');
        }

        if ($loginType === 'customer') {
            return redirect()
                ->route('customer.shop')
                ->with('error', 'You do not have access to that page.');
        }

        if ($user->hasRole('admin')) {
            return redirect('/admin')
                ->with('error', 'You do not have access to that page.');
        }

        if ($user->hasRole('dentist')) {
            return redirect()
                ->route('dentist.dashboard')
                ->with('error', 'You do not have access to that page.');
        }

        if ($user->hasRole('receptionist')) {
            return redirect()
                ->route('receptionist.dashboard')
                ->with('error', 'You do not have access to that page.');
        }

        if ($user->hasRole('cashier')) {
            return redirect()
                ->route('pos.homepage')
                ->with('error', 'You do not have access to that page.');
        }

        if ($user->hasRole('staff')) {
            return redirect()
                ->route('staff.dashboard')
                ->with('error', 'You do not have access to that page.');
        }

        return redirect()
            ->route('home')
            ->with('error', 'You do not have access to that page.');
    }
}
