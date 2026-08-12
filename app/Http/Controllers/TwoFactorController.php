<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;
use PragmaRX\Google2FA\Google2FA;
use App\Models\User;

class TwoFactorController extends Controller
{
    /**
     * Show Google Authenticator setup page
     */
    public function enable()
    {
        $user = Auth::user();

        $google2fa = new Google2FA();

        // Generate secret only once
        if (empty($user->google2fa_secret)) {

            $secret = $google2fa->generateSecretKey();

            $user->google2fa_secret = Crypt::encryptString($secret);
            $user->save();

        } else {

            $secret = Crypt::decryptString($user->google2fa_secret);

        }

        $qrCodeUrl = $google2fa->getQRCodeUrl(
            'Shine & Smile Dental Clinic',
            $user->email,
            $secret
        );

        return view('appointments.settings.2fa', compact(
            'secret',
            'qrCodeUrl'
        ));
    }

    /**
     * Verify Google Authenticator code
     */
   public function verifyLogin(Request $request)
{
    $request->validate([
        'otp' => ['required', 'digits:6'],
    ]);

    // Check if there is a pending 2FA login
    if (! session()->has('2fa:user:id')) {

        return redirect()->route('login');

    }

    $user = User::find(session('2fa:user:id'));

    if (! $user) {

        session()->forget('2fa:user:id');

        return redirect()->route('login');

    }

    $google2fa = new Google2FA();

    $secret = Crypt::decryptString(
        $user->google2fa_secret
    );

    $valid = $google2fa->verifyKey(
        $secret,
        trim($request->otp),
        2
    );

    if (! $valid) {

        return back()->withErrors([
            'otp' => '❌ Invalid or expired authentication code.',
        ]);

    }

    // OTP is correct — log the user in
    Auth::login($user);

    session()->forget('2fa:user:id');

    // Regenerate session for security
    $request->session()->regenerate();

    $role = strtolower(trim($user->role));

    return match ($role) {

        'admin' => redirect('/admin'),

        'patient' => redirect()->route('appointments.homepage'),

        'dentist' => redirect()->route('dentist.dashboard'),

        'cashier' => redirect()->route('pos.homepage'),

        'staff' => redirect()->route('staff.dashboard'),

        'customer' => redirect()->route('customer.dashboard'),

    };
}
    public function showLogin()
{
    if (! session()->has('2fa:user:id')) {

        return redirect()->route('login');

    }

    return view('auth.2fa-login');
}
}
