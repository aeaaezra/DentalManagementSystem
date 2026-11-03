<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class POSProfilePhotoController extends Controller
{
    public function upload(Request $request)
    {
        $request->validate([
            'profile_picture' => [
                'required',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],
        ]);

        $user = Auth::user();
        $photo = $request->file('profile_picture');

        // Store the new image first.
        $path = $photo->store('profile-pictures', 'public');

        if (!$path) {
            return back()->withErrors([
                'profile_picture' => 'The photo could not be saved.',
            ]);
        }

        // Delete the old image after the new image is stored.
        $oldPath = $user->profile_picture;

        $user->profile_picture = $path;
        $user->save();

        if ($oldPath && $oldPath !== $path) {
            Storage::disk('public')->delete($oldPath);
        }

        return back()->with(
            'success',
            'Profile photo updated successfully.'
        );
    }

    public function remove()
    {
        $user = Auth::user();
        $oldPath = $user->profile_picture;

        $user->profile_picture = null;
        $user->save();

        if ($oldPath) {
            Storage::disk('public')->delete($oldPath);
        }

        return back()->with(
            'success',
            'Profile photo removed successfully.'
        );
    }
}
