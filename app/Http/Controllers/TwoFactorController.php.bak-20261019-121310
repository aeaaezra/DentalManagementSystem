<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use PragmaRX\Google2FA\Google2FA;
use PragmaRX\Google2FAQRCode\Google2FA as Google2FAQrCode;

class TwoFactorController extends Controller
{
    /**
     * Show the 2FA setup page.
     */
    public function showSetup()
    {
        return view('auth.2fa-setup');
    }

    /**
     * Generate or retrieve the user's 2FA secret
     * and generate the QR code.
     */
    public function enable(Request $request)
    {
        $user = Auth::user();

        if (! $user) {
            return response()->json([
                'success' => false,
                'message' => 'You must be logged in.',
            ], 401);
        }

        /*
        |--------------------------------------------------------------------------
        | Generate secret
        |--------------------------------------------------------------------------
        */

        $google2fa = new Google2FA();

        if (empty($user->google2fa_secret)) {

            $secret = $google2fa->generateSecretKey();

            $user->google2fa_secret =
                Crypt::encryptString($secret);

            /*
             * Do not enable 2FA until the user
             * successfully verifies the first code.
             */

            $user->two_factor_enabled = false;
            $user->two_factor_confirmed_at = null;

            $user->save();

        } else {

            try {

                $secret = Crypt::decryptString(
                    $user->google2fa_secret
                );

            } catch (\Throwable $e) {

                return response()->json([
                    'success' => false,
                    'message' =>
                        'Unable to read your 2FA secret.',
                ], 500);
            }
        }


        /*
        |--------------------------------------------------------------------------
        | Generate QR Code
        |--------------------------------------------------------------------------
        */

        try {

            $qrCodeGenerator =
                new Google2FAQrCode();

            $qrCode =
                $qrCodeGenerator->getQRCodeInline(
                    'Shine & Smile Dental Clinic',
                    $user->email,
                    $secret,
                    220
                );

            $qrCode = trim((string) $qrCode);

            if ($qrCode === '') {

                throw new \RuntimeException(
                    'QR code generator returned an empty value.'
                );
            }

            /*
             * The package may return an image data URL.
             */

            if (
                str_starts_with(
                    $qrCode,
                    'data:image/'
                )
            ) {

                // Already valid for <img src="">.

            }

            /*
             * Raw SVG.
             */

            elseif (
                str_starts_with(
                    $qrCode,
                    '<svg'
                ) ||
                str_starts_with(
                    $qrCode,
                    '<?xml'
                )
            ) {

                $qrCode =
                    'data:image/svg+xml;base64,' .
                    base64_encode($qrCode);

            } else {

                throw new \RuntimeException(
                    'Unsupported QR code format returned by the QR generator.'
                );
            }

        } catch (\Throwable $e) {

            return response()->json([
                'success' => false,
                'message' =>
                    'Unable to generate the QR code: ' .
                    $e->getMessage(),
            ], 500);
        }


        /*
        |--------------------------------------------------------------------------
        | Return QR Code
        |--------------------------------------------------------------------------
        */

        return response()->json([
            'success' => true,
            'message' => '2FA setup started.',
            'secret' => $secret,
            'qrCode' => $qrCode,
        ]);
    }


    /**
     * Verify the first Google Authenticator code
     * and enable 2FA.
     */
    public function verifySetup(Request $request)
    {
        $request->validate([
            'otp' => [
                'required',
                'digits:6',
            ],
        ]);

        $user = Auth::user();

        if (! $user) {
            return response()->json([
                'success' => false,
                'message' => 'You must be logged in.',
            ], 401);
        }

        if (empty($user->google2fa_secret)) {
            return response()->json([
                'success' => false,
                'message' =>
                    '2FA setup has not been started.',
            ], 422);
        }

        try {

            $secret = Crypt::decryptString(
                $user->google2fa_secret
            );

        } catch (\Throwable $e) {

            return response()->json([
                'success' => false,
                'message' =>
                    'Unable to read your 2FA secret.',
            ], 500);
        }


        /*
        |--------------------------------------------------------------------------
        | Verify OTP
        |--------------------------------------------------------------------------
        */

        $google2fa = new Google2FA();

        $valid = $google2fa->verifyKey(
            $secret,
            trim($request->otp),
            2
        );

        if (! $valid) {

            return response()->json([
                'success' => false,
                'message' =>
                    'Invalid or expired authentication code.',
                'errors' => [
                    'otp' => [
                        'Invalid or expired authentication code.',
                    ],
                ],
            ], 422);
        }


        /*
        |--------------------------------------------------------------------------
        | Enable 2FA
        |--------------------------------------------------------------------------
        */

        $user->two_factor_enabled = true;
        $user->two_factor_confirmed_at = now();

        $user->save();


        return response()->json([
            'success' => true,
            'message' =>
                'Two-factor authentication has been enabled successfully.',
        ]);
    }


    /**
     * Disable 2FA.
     */
    public function disable(Request $request)
    {
        $user = Auth::user();

        if (! $user) {
            return response()->json([
                'success' => false,
                'message' => 'You must be logged in.',
            ], 401);
        }

        $user->two_factor_enabled = false;
        $user->google2fa_secret = null;
        $user->two_factor_confirmed_at = null;
        $user->two_factor_recovery_codes = null;

        $user->save();

        /*
         * Remove current verification state.
         */

        session()->forget('2fa_verified');

        return response()->json([
            'success' => true,
            'message' =>
                'Two-factor authentication has been disabled.',
        ]);
    }


    /**
     * Show the Google Authenticator login page.
     */
    public function showLogin()
    {
        if (! session()->has('2fa_user_id')) {
            return redirect()->route('login');
        }

        return view('auth.2fa-login');
    }


    /**
     * Verify Google Authenticator code during login.
     */
    public function verifyLogin(Request $request)
    {
        $request->validate([
            'otp' => [
                'required',
                'digits:6',
            ],
        ]);


        /*
        |--------------------------------------------------------------------------
        | Get temporary user ID
        |--------------------------------------------------------------------------
        */

        $userId =
            session('2fa_user_id');

        if (! $userId) {

            return redirect()
                ->route('login')
                ->withErrors([
                    'email' =>
                        'Your login session has expired. Please login again.',
                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | Find user
        |--------------------------------------------------------------------------
        */

        $user = User::find($userId);

        if (! $user) {

            session()->forget([
                '2fa_user_id',
                '2fa_login_type',
                '2fa_verified',
            ]);

            return redirect()
                ->route('login')
                ->withErrors([
                    'email' =>
                        'User not found. Please login again.',
                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | Make sure 2FA is enabled
        |--------------------------------------------------------------------------
        */

        if (
            ! $user->two_factor_enabled ||
            empty($user->google2fa_secret)
        ) {

            session()->forget([
                '2fa_user_id',
                '2fa_login_type',
                '2fa_verified',
            ]);

            return redirect()
                ->route('login')
                ->withErrors([
                    'email' =>
                        'Two-factor authentication is not properly configured.',
                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | Decrypt secret
        |--------------------------------------------------------------------------
        */

        try {

            $secret = Crypt::decryptString(
                $user->google2fa_secret
            );

        } catch (\Throwable $e) {

            return back()->withErrors([
                'otp' =>
                    'Unable to verify your authentication code. Please try again.',
            ]);
        }


        /*
        |--------------------------------------------------------------------------
        | Verify Google Authenticator
        |--------------------------------------------------------------------------
        */

        $google2fa = new Google2FA();

        $valid = $google2fa->verifyKey(
            $secret,
            trim($request->otp),
            2
        );

        if (! $valid) {

            return back()
                ->withInput()
                ->withErrors([
                    'otp' =>
                        'Invalid or expired authentication code.',
                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | Authentication successful
        |--------------------------------------------------------------------------
        */

        $loginType =
            session('2fa_login_type', 'normal');


        /*
        |--------------------------------------------------------------------------
        | Regenerate session BEFORE setting
        | the verified flag.
        |--------------------------------------------------------------------------
        */

        $request->session()->regenerate();


        /*
        |--------------------------------------------------------------------------
        | Log user in
        |--------------------------------------------------------------------------
        */

        Auth::login($user);


        /*
        |--------------------------------------------------------------------------
        | Mark Admin 2FA as verified
        |--------------------------------------------------------------------------
        */

        if ($loginType === 'admin') {

            session([
                '2fa_verified' => true,
            ]);

        } else {

            session()->forget(
                '2fa_verified'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | Remove temporary login data
        |--------------------------------------------------------------------------
        */

        session()->forget([
            '2fa_user_id',
            '2fa_login_type',
        ]);


        /*
        |--------------------------------------------------------------------------
        | Redirect according to login type
        |--------------------------------------------------------------------------
        */

        if ($loginType === 'appointment') {
            return redirect()->route(
                'appointments.homepage'
            );
        }

        if ($loginType === 'admin') {
            return redirect('/admin');
        }

        if ($loginType === 'cashier') {
            return redirect()->route(
                'pos.homepage'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | Fallback based on role
        |--------------------------------------------------------------------------
        */

        if ($user->hasRole('admin')) {
            return redirect('/admin');
        }

        if ($user->hasRole('patient')) {
            return redirect()->route(
                'appointments.homepage'
            );
        }

        if ($user->hasRole('customer')) {
            return redirect()->route(
                'customer.shop'
            );
        }

        if ($user->hasRole('dentist')) {
            return redirect()->route(
                'dentist.dashboard'
            );
        }

        if ($user->hasRole('receptionist')) {
            return redirect()->route(
                'receptionist.dashboard'
            );
        }

        if ($user->hasRole('cashier')) {
            return redirect()->route(
                'pos.homepage'
            );
        }

        if ($user->hasRole('staff')) {
            return redirect()->route(
                'staff.dashboard'
            );
        }

        return redirect()->route(
            'dashboard'
        );
    }
}
