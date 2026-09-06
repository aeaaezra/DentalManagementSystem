<?php

namespace App\Http\Controllers;

use App\Models\Appointments;
use App\Models\PatientRecords;
use App\Models\Service;
use Illuminate\Http\Request;

class DentistAppointmentController extends Controller
{
    public function index(Request $request)
    {
        $selectedDate = $request->input(
            'date',
            now()->format('Y-m-d')
        );

        $appointments = Appointments::with([
            'patient.user',
            'service',
        ])
            ->whereDate('appointment_date', $selectedDate)
            ->orderBy('appointment_time', 'asc')
            ->get();

        $todayAppointments = Appointments::whereDate(
            'appointment_date',
            $selectedDate
        )->count();

        $pendingAppointments = Appointments::where(
            'status',
            'pending'
        )->count();

        $confirmedAppointments = Appointments::where(
            'status',
            'approved'
        )->count();

        $completedAppointments = Appointments::where(
            'status',
            'completed'
        )->count();

        $pendingToday = Appointments::whereDate(
            'appointment_date',
            $selectedDate
        )
            ->where('status', 'pending')
            ->count();

        $confirmedToday = Appointments::whereDate(
            'appointment_date',
            $selectedDate
        )
            ->where('status', 'approved')
            ->count();

        $completedToday = Appointments::whereDate(
            'appointment_date',
            $selectedDate
        )
            ->where('status', 'completed')
            ->count();

        $nextAppointment = Appointments::with([
            'patient.user',
            'service',
        ])
            ->whereDate(
                'appointment_date',
                $selectedDate
            )
            ->whereIn('status', [
                'pending',
                'approved',
            ])
            ->whereTime(
                'appointment_time',
                '>=',
                now()->format('H:i:s')
            )
            ->orderBy('appointment_time')
            ->first();

        $services = Service::orderBy('service_name')->get();

        $patients = PatientRecords::orderBy(
            'patient_name'
        )->get();

        return view(
            'dentist.appointments',
            compact(
                'appointments',
                'services',
                'patients',
                'todayAppointments',
                'pendingAppointments',
                'confirmedAppointments',
                'completedAppointments',
                'pendingToday',
                'confirmedToday',
                'completedToday',
                'nextAppointment'
            )
        );
    }

    public function create()
    {
        $patients = PatientRecords::orderBy(
            'patient_name'
        )->get();

        $services = Service::orderBy(
            'name'
        )->get();

        return view(
            'dentist.appointments-create',
            compact(
                'patients',
                'services'
            )
        );
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'patient_record_id' => [
                'required',
                'exists:patient_records,id',
            ],
            'service_id' => [
                'required',
                'exists:services,id',
            ],
            'appointment_date' => [
                'required',
                'date',
            ],
            'appointment_time' => [
                'required',
            ],
            'reason' => [
                'nullable',
                'string',
                'max:1000',
            ],
        ]);

        $validated['status'] = 'pending';

        Appointments::create($validated);

        return redirect()
            ->route('dentist.appointments')
            ->with(
                'success',
                'Appointment created successfully.'
            );
    }

    public function show(string $id)
    {
        $appointment = Appointments::with([
            'patient.user',
            'service',
        ])->findOrFail($id);

        return redirect()
            ->route(
                'dentist.appointments',
                [
                    'date' => $appointment->appointment_date
                        ? $appointment->appointment_date->format('Y-m-d')
                        : now()->format('Y-m-d'),
                ]
            )
            ->with(
                'success',
                'Appointment selected successfully.'
            );
    }

    public function confirm(string $id)
    {
        $appointment = Appointments::findOrFail($id);

        $appointment->update([
            'status' => 'approved',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Appointment confirmed successfully.',
        ]);
    }

    public function decline(string $id)
    {
        $appointment = Appointments::findOrFail($id);

        $appointment->update([
            'status' => 'declined',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Appointment declined successfully.',
        ]);
    }

    public function complete(string $id)
    {
        $appointment = Appointments::findOrFail($id);

        $appointment->update([
            'status' => 'completed',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Appointment completed successfully.',
        ]);
    }

    public function edit(string $id)
    {
        $appointment = Appointments::findOrFail($id);

        $patients = PatientRecords::orderBy(
            'patient_name'
        )->get();

        $services = Service::orderBy(
            'name'
        )->get();

        return view(
            'dentist.appointment-edit',
            compact(
                'appointment',
                'patients',
                'services'
            )
        );
    }

    public function update(
        Request $request,
        string $id
    ) {
        $appointment = Appointments::findOrFail($id);

        $validated = $request->validate([
            'patient_record_id' => [
                'required',
                'exists:patient_records,id',
            ],
            'service_id' => [
                'required',
                'exists:services,id',
            ],
            'appointment_date' => [
                'required',
                'date',
            ],
            'appointment_time' => [
                'required',
            ],
            'reason' => [
                'nullable',
                'string',
                'max:1000',
            ],
        ]);

        $appointment->update($validated);

        return redirect()
            ->route('dentist.appointments')
            ->with(
                'success',
                'Appointment updated successfully.'
            );
    }

    public function destroy(string $id)
    {
        $appointment = Appointments::findOrFail($id);

        $appointment->delete();

        return redirect()
            ->route('dentist.appointments')
            ->with(
                'success',
                'Appointment deleted successfully.'
            );
    }
}
