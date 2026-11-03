<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\Password;

class CustomerRegistrationController extends Controller
{
    /**
     * Display the customer registration form.
     */
    public function create()
    {
        return view('auth.customer-register');
    }

    /**
     * Validate and create a customer account.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:100',
            ],

            'phone' => [
                'nullable',
                'string',
                'max:20',
            ],

            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:users,email',
            ],

            'password' => [
                'required',
                'confirmed',
                Password::min(8)
                    ->mixedCase()
                    ->numbers()
                    ->symbols(),
            ],

            'terms' => [
                'required',
                'accepted',
            ],
        ], [
            'email.unique' => 'This email address is already registered. Please sign in instead.',
            'password.confirmed' => 'Your password confirmation does not match.',
            'terms.accepted' => 'You must agree to the Terms and Conditions and Privacy Policy.',
        ]);

        // Create the account and assign its role together.
        $user = DB::transaction(function () use ($validated) {
            $user = new User();

            $user->name = $validated['name'];
            $user->email = $validated['email'];
            $user->phone = $validated['phone'] ?? null;
            $user->role = 'customer';

            // The User model's "hashed" cast hashes this password.
            $user->password = $validated['password'];

            // New accounts must not receive staff or admin access.
            $user->save();
            $user->assignRole('customer');

            return $user;
        });

        // Sign in only after account creation succeeds.
        Auth::login($user);
        $request->session()->regenerate();

        return redirect()
            ->route('customer.products')
            ->with('success', 'Your customer account has been created successfully.');
    }
}
