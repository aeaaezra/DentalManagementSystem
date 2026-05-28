<?php

namespace App\Http\Controllers;

use App\Models\Appointments;
use App\Models\PatientRecords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    // SHOW FORM
    public function create()
    {
        return view('appointments.create');
    }

    // SAVE APPOINTMENT
    public function store(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'appointment_date' => 'required|date',
            'appointment_time' => 'required',
            'reason' => 'nullable|string|max:255',
        ]);

        // Prevent double booking
        $exists = Appointments::where('appointment_date', $request->appointment_date)
            ->where('appointment_time', $request->appointment_time)
            ->exists();

        if ($exists) {
            return back()->with('error', 'Time slot already booked!');
        }

        // 1. FIND OR CREATE PATIENT (FIX IMPORTANT)
        $patient = PatientRecords::firstOrCreate(
            ['patient_name' => $request->full_name],
            []
        );

        // 2. CREATE APPOINTMENT
        Appointments::create([
            'patient_record_id' => $patient->id,
            'appointment_date' => $request->appointment_date,
            'appointment_time' => $request->appointment_time,
            'reason' => $request->reason,
            'status' => 'pending',
        ]);

        return redirect()->back()->with('success', 'Appointment submitted!');
    }

    // ADMIN VIEW
    public function index()
    {
        $appointments = Appointments::with('patient')
            ->latest()
            ->get();

        return view('admin.appointment.index', compact('appointments'));
    }

    // ACCEPT
    public function accept($id)
    {
        Appointments::findOrFail($id)
            ->update(['status' => 'accepted']);

        return back()->with('success', 'Appointment accepted');
    }

    // DECLINE
    public function decline($id)
    {
        Appointments::findOrFail($id)
            ->update(['status' => 'declined']);

        return back()->with('success', 'Appointment declined');
    }
}
