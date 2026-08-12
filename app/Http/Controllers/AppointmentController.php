<?php

namespace App\Http\Controllers;

use App\Models\Appointments;
use App\Models\PatientRecords;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Service;
use App\Models\User;
use App\Notifications\AppointmentApproved;
use App\Notifications\AppointmentDeclined;
use App\Models\Guide;

class AppointmentController extends Controller
{
    // STORE APPOINTMENT
    public function store(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'appointment_date' => 'required|date',
            'appointment_time' => 'required',
            'service_id' => 'required|exists:services,id',
            'reason' => 'nullable|string|max:255',
        ]);

        $start = Carbon::parse($request->appointment_date . ' ' . $request->appointment_time);
        $service = Service::findOrFail($request->service_id);
        $end = $start->copy()->addMinutes($service->duration);

        // Prevent overlap
        $exists = Appointments::where('appointment_date', $request->appointment_date)
            ->where(function ($q) use ($start, $end) {
                $q->where('appointment_time', '<', $end->format('H:i:s'))
                  ->where('end_time', '>', $start->format('H:i:s'));
            })
            ->exists();

        if ($exists) {
            return back()->with('error', 'Time slot already booked!');
        }

        // Create patient
        $patient = PatientRecords::firstOrCreate([
            'patient_name' => $request->full_name
        ]);

        Appointments::create([
            'user_id' => auth()->id(),
            'patient_record_id' => $patient->id,
            'service_id' => $request->service_id,
            'appointment_date' => $request->appointment_date,
            'appointment_time' => $start->format('H:i:s'),
            'end_time' => $end->format('H:i:s'),
            'reason' => $request->reason,
            'status' => 'pending',
        ]);

        return back()->with('success', 'Appointment submitted!');
    }

    // UPDATE (APPROVE / COMPLETE)
    public function update(Request $request, $id)
    {
        $request->validate([
            'diagnosis' => 'nullable|string|max:1000',
            'treatment_summary' => 'nullable|string',
            'status' => 'required|in:pending,accepted,declined,completed',
        ]);

        $appointment = Appointments::findOrFail($id);

        $appointment->update([
            'diagnosis' => $request->diagnosis,
            'treatment_summary' => $request->treatment_summary,
            'status' => $request->status,
        ]);

        // ✅ Use relationship instead of manual User::find
        if ($request->status === 'accepted' && $appointment->user) {
            $appointment->user->notify(new AppointmentApproved($appointment));
        }

        if ($request->status === 'declined' && $appointment->user) {
            $appointment->user->notify(new AppointmentDeclined($appointment));
        }

        return back()->with('success', 'Appointment updated!');
    }

    // ✅ DECLINE (ONLY ONE METHOD!)
    public function decline($id)
    {
        $appointment = Appointments::findOrFail($id);

        $appointment->update([
            'status' => 'declined'
        ]);

        // ✅ CLEAN NOTIFICATION
        if ($appointment->user) {
            $appointment->user->notify(new AppointmentDeclined($appointment));
        }

        return back()->with('success', 'Appointment declined and patient notified.');
    }

    // ADMIN VIEW
    public function index()
    {
        $appointments = Appointments::with('patient')->latest()->get();

        return view('admin.appointment.index', compact('appointments'));
    }

    // HOMEPAGE
    public function homepage()
    {
        $appointmentHistory = Appointments::where('user_id', auth()->id())->get();
        $services = Service::all();
        $guides = Guide::all();

        return view('appointments.appointment-homepage', compact(
            'appointmentHistory',
            'services',
            'guides'
        ));
    }
}
