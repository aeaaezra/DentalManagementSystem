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
    public function create(): View
    {
        return view('auth.login');
    }

    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        $loginRoute = $request->route()->getName();

        $loginType = match ($loginRoute) {
            'appointments.login.store' => 'appointment',
            'customer.login.store' => 'customer',
            'admin.login.store' => 'admin',
            'dentist.login.store' => 'dentist',
            'receptionist.login.store' => 'receptionist',
            'pos.login.post' => 'cashier',
            default => 'normal',
        };

        session([
            'login_type' => $loginType,
        ]);

        if ($loginRoute === 'appointments.login.store') {
            if (!$user->hasRole('patient')) {
                Auth::logout();

                return back()
                    ->withErrors([
                        'email' => 'This account does not have access to the Appointment Portal.',
                    ])
                    ->onlyInput('email');
            }

            if (
                $user->two_factor_enabled &&
                !empty($user->google2fa_secret)
            ) {
                session([
                    '2fa_user_id' => $user->id,
                    '2fa_login_type' => 'appointment',
                ]);

                Auth::logout();

                return redirect()->route('2fa.login');
            }

            return redirect()->route('appointments.homepage');
        }

        if ($loginRoute === 'customer.login.store') {
            if (!$user->hasRole('customer')) {
                Auth::logout();

                return back()
                    ->withErrors([
                        'email' => 'This account does not have access to the Ordering Portal.',
                    ])
                    ->onlyInput('email');
            }

            return redirect()->route('customer.shop');
        }

        if ($loginRoute === 'admin.login.store') {
            if (!$user->hasRole('admin')) {
                Auth::logout();

                return back()
                    ->withErrors([
                        'email' => 'Only administrators can log in here.',
                    ])
                    ->onlyInput('email');
            }

            if (
                $user->two_factor_enabled &&
                !empty($user->google2fa_secret)
            ) {
                session([
                    '2fa_user_id' => $user->id,
                    '2fa_login_type' => 'admin',
                ]);

                Auth::logout();

                return redirect()->route('2fa.login');
            }

            return redirect('/admin');
        }

        if ($loginRoute === 'dentist.login.store') {
            if (!$user->hasRole('dentist')) {
                Auth::logout();

                return back()
                    ->withErrors([
                        'email' => 'Only dentist accounts can log in here.',
                    ])
                    ->onlyInput('email');
            }

            if (
                $user->two_factor_enabled &&
                !empty($user->google2fa_secret)
            ) {
                session([
                    '2fa_user_id' => $user->id,
                    '2fa_login_type' => 'dentist',
                ]);

                Auth::logout();

                return redirect()->route('2fa.login');
            }

            return redirect()->route('dentist.dashboard');
        }

        if ($loginRoute === 'receptionist.login.store') {
            if (!$user->hasRole('receptionist')) {
                Auth::logout();

                return back()
                    ->withErrors([
                        'email' => 'Only receptionist accounts can log in here.',
                    ])
                    ->onlyInput('email');
            }

            if (
                $user->two_factor_enabled &&
                !empty($user->google2fa_secret)
            ) {
                session([
                    '2fa_user_id' => $user->id,
                    '2fa_login_type' => 'receptionist',
                ]);

                Auth::logout();

                return redirect()->route('2fa.login');
            }

            return redirect()->route('receptionist.dashboard');
        }

        if ($loginRoute === 'pos.login.post') {
            if (!$user->hasRole('cashier')) {
                Auth::logout();

                return back()
                    ->withErrors([
                        'email' => 'Only cashier accounts can log in here.',
                    ])
                    ->onlyInput('email');
            }

            if (
                $user->two_factor_enabled &&
                !empty($user->google2fa_secret)
            ) {
                session([
                    '2fa_user_id' => $user->id,
                    '2fa_login_type' => 'cashier',
                ]);

                Auth::logout();

                return redirect()->route('2fa.login');
            }

            return redirect()->route('pos.homepage');
        }

        if ($loginRoute === 'login' && $user->hasRole('admin')) {
            Auth::logout();

            return back()
                ->withErrors([
                    'email' => 'Administrators must sign in through the Admin Login page.',
                ])
                ->onlyInput('email');
        }

        if (
            $user->two_factor_enabled &&
            !empty($user->google2fa_secret)
        ) {
            session([
                '2fa_user_id' => $user->id,
                '2fa_login_type' => 'normal',
            ]);

            Auth::logout();

            return redirect()->route('2fa.login');
        }

        if ($user->hasRole('admin')) {
            return redirect('/admin');
        }

        if ($user->hasRole('patient')) {
            return redirect()->route('appointments.homepage');
        }

        if ($user->hasRole('customer')) {
            return redirect()->route('customer.shop');
        }

        if ($user->hasRole('dentist')) {
            return redirect()->route('dentist.dashboard');
        }

        if ($user->hasRole('receptionist')) {
            return redirect()->route('receptionist.dashboard');
        }

        if ($user->hasRole('cashier')) {
            return redirect()->route('pos.homepage');
        }

        if ($user->hasRole('staff')) {
            return redirect()->route('staff.dashboard');
        }

        return redirect()->route('dashboard');
    }

    public function destroy(Request $request): RedirectResponse
    {
        $loginType = session('login_type');

        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return match ($loginType) {
            'appointment' => redirect()->route('appointments.landing'),
            'customer' => redirect()->route('customer.login'),
            'admin' => redirect()->route('admin.login'),
            'dentist' => redirect()->route('dentist.landingpage'),
            'receptionist' => redirect()->route('receptionist.login'),
            'cashier' => redirect()->route('pos.login'),
            default => redirect()->route('home'),
        };
    }
}
