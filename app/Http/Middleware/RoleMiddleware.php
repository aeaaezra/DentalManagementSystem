<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // If not logged in → redirect to login
        if (!Auth::check()) {
            return redirect()->route('appointments.login')->with('error', 'Please log in to access that page.');
        }

        $user = Auth::user();

        // If no role assigned
        if (!$user->role) {
            abort(403, 'No role assigned.');
        }

        // Normalize roles
        $userRole = strtolower($user->role);
        $allowedRoles = array_map('strtolower', $roles);

        // Check if role is allowed → redirect to their dashboard if not
        if (!in_array($userRole, $allowedRoles)) {
            return redirect()
                ->route($this->getDashboardRoute($userRole))
                ->with('error', 'You do not have access to that page.');
        }

        return $next($request);
    }

    /**
     * Get the dashboard route for a given role.
     */
    private function getDashboardRoute(string $role): string
{
    return match($role) {
        'admin' => 'admin.dashboard',
        'dentist' => 'dentist.dashboard',
        'staff' => 'staff.dashboard',
        'manager' => 'manager.dashboard',
        'cashier' => 'pos.homepage',

        'customer' => 'pos.homepage',
        'patient' => 'appointments.homepage',
        default => 'home',
    };
}

}
