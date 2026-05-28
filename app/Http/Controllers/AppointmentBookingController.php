<?php

namespace App\Http\Controllers;

use App\Models\Appointments;
use Illuminate\Http\Request;

class AppointmentBookingController extends Controller
{
    public function create()
    {
        return view('appointments.book');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'patient_name' => ['required', 'string', 'max:255'],
            'age' => ['nullable', 'integer', 'min:1'],
            'sex' => ['nullable', 'string'],
            'civil_status' => ['nullable', 'string'],
            'tel_no' => ['nullable', 'string', 'max:50'],
            'occupation' => ['nullable', 'string', 'max:255'],
            'address' => ['nullable', 'string'],
            'appointment_date' => ['required', 'date'],
            'appointment_time' => ['required'],
            'reason' => ['required', 'string'],
        ]);

        $exists = Appointments::where('appointment_date', $validated['appointment_date'])
            ->where('appointment_time', $validated['appointment_time'])
            ->exists();

        if ($exists) {
            return back()
                ->withInput()
                ->withErrors([
                    'appointment_time' => 'This appointment time is already booked.',
                ]);
        }

        $validated['status'] = 'pending';

        Appointments::create($validated);

        return redirect()
            ->route('appointments.book')
            ->with('success', 'Your appointment request has been submitted successfully.');
    }
}
