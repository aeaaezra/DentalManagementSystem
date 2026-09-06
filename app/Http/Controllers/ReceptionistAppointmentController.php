<?php

namespace App\Http\Controllers;

use App\Models\Appointments;
use Carbon\Carbon;

class ReceptionistAppointmentController extends Controller
{
    public function dashboard()
    {
        $today = Carbon::today();

        $appointments = Appointments::with([
            'patient',
            'service',
        ])
            ->whereDate('appointment_date', $today)
            ->orderBy('appointment_time', 'asc')
            ->get();

        $totalAppointments = $appointments->count();

        $waitingAppointments = $appointments
            ->where('status', 'accepted')
            ->whereNull('checked_in_at')
            ->count();

        $checkedInAppointments = $appointments
            ->whereNotNull('checked_in_at')
            ->whereNull('treatment_started_at')
            ->count();

        $inTreatmentAppointments = $appointments
            ->whereNotNull('treatment_started_at')
            ->whereNull('checked_out_at')
            ->count();

        $completedAppointments = $appointments
            ->whereNotNull('checked_out_at')
            ->count();

        $noShowAppointments = $appointments
            ->where('status', 'no_show')
            ->count();

        return view(
            'receptionist.dashboard',
            compact(
                'appointments',
                'totalAppointments',
                'waitingAppointments',
                'checkedInAppointments',
                'inTreatmentAppointments',
                'completedAppointments',
                'noShowAppointments'
            )
        );
    }

    public function checkIn(Appointments $appointment)
    {
        if ($appointment->checked_in_at) {
            return back()->with(
                'error',
                'This patient has already been checked in.'
            );
        }

        $status = strtolower(trim($appointment->status ?? ''));

            if (!in_array($status, ['accepted', 'confirmed'])) {
                return back()->with(
                    'error',
                    'Only accepted or confirmed appointments can be checked in.'
                );
            }

        $appointment->update([
            'checked_in_at' => now(),
        ]);

        return back()->with(
            'success',
            'Patient checked in successfully.'
        );
    }

    public function startTreatment(Appointments $appointment)
    {
        if (! $appointment->checked_in_at) {
            return back()->with(
                'error',
                'Please check in the patient first.'
            );
        }

        if ($appointment->treatment_started_at) {
            return back()->with(
                'error',
                'Treatment has already started.'
            );
        }

        $appointment->update([
            'treatment_started_at' => now(),
        ]);

        return back()->with(
            'success',
            'Treatment started successfully.'
        );
    }

    public function checkOut(Appointments $appointment)
    {
        if (! $appointment->checked_in_at) {
            return back()->with(
                'error',
                'Patient has not been checked in.'
            );
        }

        if (! $appointment->treatment_started_at) {
            return back()->with(
                'error',
                'Treatment has not started yet.'
            );
        }

        if ($appointment->checked_out_at) {
            return back()->with(
                'error',
                'Patient has already been checked out.'
            );
        }

        $appointment->update([
            'checked_out_at' => now(),
            'status' => 'completed',
        ]);

        return back()->with(
            'success',
            'Patient checked out successfully.'
        );
    }
}
