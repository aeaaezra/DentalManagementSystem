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

    public function reviewLateAppointment(\Illuminate\Http\Request $request, int $appointment)
    {
        $validated = $request->validate([
            'decision' => ['required', 'in:patient_arrived,patient_not_arrived'],
            'late_review_notes' => ['nullable', 'string', 'max:2000'],
        ]);

        $result = \Illuminate\Support\Facades\DB::transaction(function () use ($appointment, $validated) {
            $record = Appointments::whereKey($appointment)->lockForUpdate()->firstOrFail();

            $status = strtolower(trim($record->status ?? ''));

            if (! in_array($status, ['accepted', 'confirmed'], true)) {
                return 'This appointment is no longer eligible for late review.';
            }

            if ($record->checked_in_at || $record->treatment_started_at || $record->checked_out_at) {
                return 'This appointment has already started its check-in or treatment workflow.';
            }

            if (! $record->appointment_date || ! $record->appointment_time) {
                return 'The appointment date or time is missing. Please review it manually.';
            }

            $appointmentDateTime = \Carbon\Carbon::parse(
                $record->appointment_date->format('Y-m-d') . ' ' . $record->appointment_time
            );

            if (! $appointmentDateTime->isToday() || now()->lessThanOrEqualTo($appointmentDateTime->copy()->addMinutes(30))) {
                return 'This appointment is not currently eligible for late review.';
            }

            if ($record->late_review_status !== null) {
                return 'This appointment has already been reviewed. Refresh the dashboard before continuing.';
            }

            $record->update([
                'late_review_status' => $validated['decision'],
                'late_reviewed_at' => now(),
                'late_reviewed_by' => auth()->id(),
                'late_review_notes' => $validated['late_review_notes'] ?? null,
            ]);

            return null;
        });

        if ($result !== null) {
            return back()->with('error', $result);
        }

        $message = $validated['decision'] === 'patient_arrived'
            ? 'Review saved: patient arrived. Keep the existing appointment and check the patient in.'
            : 'Review saved: patient did not arrive. The appointment is flagged for a separate rescheduling step. No booking was changed.';

        return back()->with('success', $message);
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
