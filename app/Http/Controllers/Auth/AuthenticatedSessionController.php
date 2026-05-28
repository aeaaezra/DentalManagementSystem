<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Show the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // Authenticate user
        $request->authenticate();

        // Regenerate session
        $request->session()->regenerate();

        // Get logged in user
        $user = Auth::user();

        // If no user found
        if (!$user) {
            return redirect()->route('login');
        }

        // Convert role to lowercase and remove spaces
        $role = strtolower(trim($user->role));

        // Redirect based on role
        return match ($role) {

            'admin' => redirect('/admin'),

            'patient' => redirect('/appointments-booking'),

            'dentist' => redirect('/dentist'),

            'cashier' => redirect('/cashier'),

            'staff' => redirect('/staff'),

            // Default redirect if role does not match
            default => redirect('/admin'),
        };
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
