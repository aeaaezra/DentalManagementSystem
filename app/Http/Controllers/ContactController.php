<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    // SHOW CONTACT PAGE
    public function index()
    {
        return view(
            'appointments.contact'
        );
    }

    // STORE CONTACT MESSAGE
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ],
            'email' => [
                'required',
                'email',
                'max:255',
            ],
            'subject' => [
                'required',
                'string',
                'max:255',
            ],
            'message' => [
                'required',
                'string',
                'max:1000',
            ],
        ]);

        Contact::create([
            'user_id' => auth()->id(),
            'name' => $validated['name'],
            'email' => $validated['email'],
            'subject' => $validated['subject'],
            'message' => $validated['message'],
            'status' => 'unread',
        ]);

        return redirect()
            ->route('contact')
            ->with(
                'success',
                'Your message has been sent successfully. Our clinic team will get back to you soon.'
            );
    }

    // SEND CONTACT MESSAGE FROM WELCOME PAGE
    public function send(Request $request)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ],
            'email' => [
                'required',
                'email',
                'max:255',
            ],
            'subject' => [
                'required',
                'string',
                'max:255',
            ],
            'message' => [
                'required',
                'string',
                'max:1000',
            ],
        ]);

        Contact::create([
            'user_id' => auth()->id(),
            'name' => $validated['name'],
            'email' => $validated['email'],
            'subject' => $validated['subject'],
            'message' => $validated['message'],
            'status' => 'unread',
        ]);

        return back()->with(
            'success',
            'Your message has been sent successfully. Our clinic team will get back to you soon.'
        );
    }
}
