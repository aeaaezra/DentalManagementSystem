<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class SettingsController extends Controller
{
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required'],
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        if (! Hash::check($request->current_password, auth()->user()->password)) {

            return back()->withErrors([
                'current_password' => 'Current password is incorrect.',
            ]);
        }

        auth()->user()->update([
            'password' => Hash::make($request->password),
        ]);

        return back()->with('success', 'Password updated successfully.');
    }



public function index(Request $request)
{
    if ($request->filled('return')) {
        session([
            'settings_return_url' => $request->return,
        ]);
    }

    return view('appointments.settings', [
        'user' => Auth::user(),
    ]);
}
}
