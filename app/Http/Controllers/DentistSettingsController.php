<?php

namespace App\Http\Controllers;

use App\Models\DentistSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class DentistSettingsController extends Controller
{
    // ============================================================
    // SETTINGS PAGE
    // ============================================================

    public function index()
    {
        // Get currently authenticated dentist
        $user = Auth::user();


        $settings =
            DentistSetting::firstOrCreate(
                [
                    'user_id' => $user->id,
                ],
                [
                    'appointment_notifications' => true,

                    'treatment_notifications' => true,

                    'system_notifications' => true,
                ]
            );

        return view(
            'dentist.settings',
            compact(
                'user',
                'settings'
            )
        );
    }



    public function updateProfile(
        Request $request
    ) {

        // Get currently authenticated dentist
        $user = Auth::user();

        $validated =
            $request->validate([
                'phone' => [
                    'nullable',
                    'string',
                    'max:20',
                    'regex:/^09\d{9}$/',
                ],

                'profile_photo' => [
                    'nullable',
                    'image',
                    'mimes:jpg,jpeg,png,webp',
                    'max:2048',
                ],
            ]);

        if (
            $request->has(
                'phone'
            )
        ) {

            $user->phone =
                $validated['phone'] ?? null;
        }


        if (
            $request->hasFile(
                'profile_photo'
            )
        ) {

            $photo =
                $request->file(
                    'profile_photo'
                );

            if (
                !empty(
                    $user->profile_photo
                )
            ) {

                Storage::disk('public')
                    ->delete(
                        $user->profile_photo
                    );
            }


            $path =
                $photo->store(
                    'profile-photos',
                    'public'
                );

            $user->profile_photo =
                $path;
        }

        $user->save();


        $profilePhotoUrl =
            !empty(
                $user->profile_photo
            )
                ? Storage::url(
                    $user->profile_photo
                )
                : null;


        // ========================================================
        // JSON RESPONSE
        // ========================================================

        return response()->json([
            'success' => true,

            'message' =>
                'Profile updated successfully.',

            'profile_photo' =>
                $profilePhotoUrl,
        ]);
    }


    // ============================================================
    // UPDATE PASSWORD
    // ============================================================

    public function updatePassword(
        Request $request
    ) {

        // Get authenticated dentist
        $user =
            Auth::user();


        // ========================================================
        // VALIDATE PASSWORD
        // ========================================================

        $validated =
            $request->validate([
                'current_password' => [
                    'required',
                    'current_password',
                ],

                'password' => [
                    'required',
                    'confirmed',

                    Password::min(8)
                        ->letters()
                        ->numbers()
                        ->symbols(),
                ],
            ]);


        // ========================================================
        // UPDATE PASSWORD
        // ========================================================

        $user->password =
            Hash::make(
                $validated['password']
            );


        // ========================================================
        // SAVE USER
        // ========================================================

        $user->save();


        // ========================================================
        // RESPONSE
        // ========================================================

        return response()->json([
            'success' => true,

            'message' =>
                'Password changed successfully.',
        ]);
    }

// ============================================================
// UPDATE NOTIFICATION PREFERENCES
// ============================================================

public function updatePreferences(Request $request)
{
    // Get authenticated dentist
    $user = Auth::user();


    // Find existing settings
    // or create them if they do not exist
    $settings = DentistSetting::firstOrCreate(
        [
            'user_id' => $user->id,
        ],
        [
            'appointment_notifications' => true,
            'treatment_notifications' => true,
            'system_notifications' => true,
        ]
    );


    // Update notification preferences
    $settings->appointment_notifications =
        $request->boolean(
            'appointment_notifications'
        );

    $settings->treatment_notifications =
        $request->boolean(
            'treatment_notifications'
        );

    $settings->system_notifications =
        $request->boolean(
            'system_notifications'
        );


    // Save to database
    $settings->save();


    // Redirect back to Settings page
    return redirect()
        ->route('dentist.settings')
        ->with(
            'success',
            'Notification preferences saved successfully.'
        );
}


    // ============================================================
    // UPDATE APPEARANCE
    // ============================================================

    public function updateAppearance(
        Request $request
    ) {

        // Get authenticated dentist
        $user =
            Auth::user();


        // ========================================================
        // VALIDATE THEME
        // ========================================================

        $validated =
            $request->validate([
                'theme' => [
                    'required',
                    'in:light,dark,system',
                ],
            ]);


        // ========================================================
        // SAVE THEME
        // ========================================================

        $user->theme =
            $validated['theme'];


        // ========================================================
        // SAVE USER
        // ========================================================

        $user->save();


        // ========================================================
        // RESPONSE
        // ========================================================

        return response()->json([
            'success' => true,

            'message' =>
                'Appearance settings saved successfully.',

            'theme' =>
                $user->theme,
        ]);
    }
}
