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
     * Handle login request
     */
  public function store(LoginRequest $request): RedirectResponse
{
    // Authenticate user
    $request->authenticate();

    // Regenerate session
    $request->session()->regenerate();

    // Get authenticated user
    $user = Auth::user();

if (!$user) {
    return redirect()->route('login');
}

/*
|--------------------------------------------------------------------------
| Google Authenticator Check
|--------------------------------------------------------------------------
*/

if ($user->two_factor_enabled) {

    // Save the user ID temporarily
    session([
        '2fa:user:id' => $user->id,
    ]);

    // Logout until OTP is verified
    Auth::logout();

    return redirect()->route('2fa.login');
}

// Normalize role
$role = strtolower(trim($user->role ?? ''));

    // Normalize role
    $role = strtolower(trim($user->role ?? ''));

    /*
    |--------------------------------------------------------------------------
    | Admin Login (/admin-login)
    |--------------------------------------------------------------------------
    | Only administrators are allowed.
    */
    if (
        $request->route()->getName() === 'admin.login.store'
        && $role !== 'admin'
    ) {
        Auth::logout();

        return back()->withErrors([
            'email' => 'Only administrators can log in here.',
        ])->onlyInput('email');
    }

    /*
    |--------------------------------------------------------------------------
    | Normal Login (/login)
    |--------------------------------------------------------------------------
    | Everyone EXCEPT admin can log in here.
    */
    if (
        $request->route()->getName() === 'login'
        && $role === 'admin'
    ) {
        Auth::logout();

        return back()->withErrors([
            'email' => 'Administrators must sign in through the Admin Login page.',
        ])->onlyInput('email');
    }

    /*
    |--------------------------------------------------------------------------
    | POS Login (/pos/login)
    |--------------------------------------------------------------------------
    | Cashier only.
    */
    if (
        $request->route()->getName() === 'pos.login.post'
        && $role !== 'cashier'
    ) {
        Auth::logout();

        return back()->withErrors([
            'email' => 'Only cashier accounts can log in here.',
        ])->onlyInput('email');
    }

    /*
    |--------------------------------------------------------------------------
    | Redirect users
    |--------------------------------------------------------------------------
    */

    return match ($role) {

        'admin' => redirect('/admin'),

        'patient' => redirect()->route('appointments.homepage'),

        'dentist' => redirect()->route('dentist.dashboard'),

        'cashier' => redirect()->route('pos.homepage'),

        'staff' => redirect()->route('staff.dashboard'),

        'customer' => redirect()->route('customer.dashboard'),

        default => redirect('/dashboard'),
    };
}

    /**
     * Logout
     */
public function destroy(Request $request): RedirectResponse
{
    $user = Auth::user();
    $role = $user?->role;

    Auth::guard('web')->logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    if ($role === 'patient') {
        return redirect()->route('appointments.landing');
    }
    if ($role === 'cashier') {
        return redirect()->route('pos.pos-landing');
    }

    return redirect('/');
}
}
