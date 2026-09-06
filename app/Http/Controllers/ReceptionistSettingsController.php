<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Contracts\Encryption\DecryptException;
use PragmaRX\Google2FA\Google2FA;

class ReceptionistSettingsController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | SETTINGS PAGE
    |--------------------------------------------------------------------------
    */

    public function index(Request $request)
    {
        $user = $request->user();

        return view(
            'receptionist.settings.index',
            [
                'user' => $user,
            ]
        );
    }


    /*
    |--------------------------------------------------------------------------
    | UPDATE SETTINGS
    |--------------------------------------------------------------------------
    */

    public function update(Request $request)
    {
        $user = $request->user();

        /*
        |--------------------------------------------------------------------------
        | VALIDATION
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate([
            'profile_picture' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],

            'appointment_reminders' => [
                'nullable',
                'boolean',
            ],

            'promotional_emails' => [
                'nullable',
                'boolean',
            ],
        ]);


        /*
        |--------------------------------------------------------------------------
        | PROFILE PICTURE
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('profile_picture')) {

            $path = $request
                ->file('profile_picture')
                ->store(
                    'profile-pictures',
                    'public'
                );

            $user->profile_picture = $path;
        }


        /*
        |--------------------------------------------------------------------------
        | NOTIFICATION PREFERENCES
        |--------------------------------------------------------------------------
        */

        $user->appointment_reminders =
            $request->boolean(
                'appointment_reminders'
            );

        $user->promotional_emails =
            $request->boolean(
                'promotional_emails'
            );


        /*
        |--------------------------------------------------------------------------
        | SAVE
        |--------------------------------------------------------------------------
        */

        $user->save();


        return back()->with(
            'success',
            'Profile updated successfully.'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | CHANGE PASSWORD
    |--------------------------------------------------------------------------
    */

    public function updatePassword(Request $request)
    {
        $request->validate(
            [
                'current_password' => [
                    'required',
                    'current_password:web',
                ],

                'password' => [
                    'required',
                    'string',
                    'min:8',
                    'confirmed',
                    'regex:/[A-Z]/',
                    'regex:/[a-z]/',
                    'regex:/[0-9]/',
                    'regex:/[^A-Za-z0-9]/',
                ],
            ],
            [
                'password.regex' =>
                    'The password must contain at least one uppercase letter, one lowercase letter, one number, and one special character.',
            ]
        );


        $request->user()->update([
            'password' => Hash::make(
                $request->password
            ),
        ]);


        return back()->with(
            'password_success',
            'Password changed successfully.'
        );
    }


    public function enableTwoFactor(Request $request)
    {
        $user = $request->user();


        /*
        |--------------------------------------------------------------------------
        | ALREADY ENABLED
        |--------------------------------------------------------------------------
        */

        if ($user->two_factor_enabled) {

            return back()->with(
                'two_factor_error',
                'Google Authenticator is already enabled.'
            );
        }




        $google2fa = new Google2FA();

        $secret = $google2fa->generateSecretKey();

        $encryptedSecret =
            Crypt::encryptString(
                $secret
            );

        $user->google2fa_secret =
            $encryptedSecret;

        $user->two_factor_secret =
            $encryptedSecret;


        $user->two_factor_enabled = false;

        $user->two_factor_confirmed_at = null;

        $user->save();


        return redirect()->route(
            'receptionist.settings.2fa.setup'
        );
    }


    public function showTwoFactorSetup(Request $request)
    {
        $user = $request->user();

        if (
            !$user->google2fa_secret &&
            !$user->two_factor_secret
        ) {

            return redirect()
                ->route(
                    'receptionist.settings'
                )
                ->with(
                    'two_factor_error',
                    'Please start the Google Authenticator setup first.'
                );
        }



        $encryptedSecret =
            $user->google2fa_secret
            ?: $user->two_factor_secret;


        try {

            $secret =
                Crypt::decryptString(
                    $encryptedSecret
                );

        } catch (DecryptException $e) {

            $user->google2fa_secret = null;

            $user->two_factor_secret = null;

            $user->two_factor_enabled = false;

            $user->two_factor_confirmed_at = null;

            $user->save();


            return redirect()
                ->route(
                    'receptionist.settings'
                )
                ->with(
                    'two_factor_error',
                    'Your previous Google Authenticator setup was invalid. Please set it up again.'
                );
        }



        $google2fa = new Google2FA();

        $appName = config(
            'app.name',
            'Dental Management System'
        );


        $qrCodeUrl =
            $google2fa->getQRCodeUrl(
                $appName,
                $user->email,
                $secret
            );


        return view(
            'receptionist.settings.2fa-setup',
            [
                'user' => $user,

                'secret' => $secret,

                'qrCodeUrl' => $qrCodeUrl,
            ]
        );
    }


    public function verifyTwoFactor(Request $request)
    {


        $request->validate([
            'code' => [
                'required',
                'digits:6',
            ],
        ]);


        $user = $request->user();

        $encryptedSecret =
            $user->google2fa_secret
            ?: $user->two_factor_secret;


        if (!$encryptedSecret) {

            return redirect()
                ->route(
                    'receptionist.settings'
                )
                ->with(
                    'two_factor_error',
                    'No Google Authenticator setup was found.'
                );
        }


        try {

            $secret =
                Crypt::decryptString(
                    $encryptedSecret
                );

        } catch (DecryptException $e) {

            return redirect()
                ->route(
                    'receptionist.settings'
                )
                ->with(
                    'two_factor_error',
                    'The Google Authenticator setup is invalid. Please set it up again.'
                );
        }


        $google2fa = new Google2FA();

        $valid =
            $google2fa->verifyKey(
                $secret,
                trim($request->code),
                2
            );

        if (!$valid) {

            return back()
                ->withInput()
                ->with(
                    'two_factor_error',
                    'Invalid verification code. Please try again.'
                );
        }

        $user->two_factor_enabled = true;

        $user->two_factor_confirmed_at = now();


        $user->save();


        return redirect()
            ->route(
                'receptionist.settings'
            )
            ->with(
                'two_factor_success',
                'Google Authenticator has been successfully enabled.'
            );
    }


    public function disableTwoFactor(Request $request)
    {
        $user = $request->user();


        $user->two_factor_enabled = false;

        $user->google2fa_secret = null;

        $user->two_factor_secret = null;

        $user->two_factor_confirmed_at = null;



        $user->save();


        return back()->with(
            'two_factor_success',
            'Google Authenticator has been disabled.'
        );
    }
}
