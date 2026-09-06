<?php

namespace App\Http\Controllers;

use App\Models\Appointments;
use App\Models\Guide;
use App\Models\PatientRecords;
use App\Models\Service;
use App\Models\User;
use App\Notifications\AppointmentApproved;
use App\Notifications\AppointmentCancelled;
use App\Notifications\AppointmentDeclined;
use App\Notifications\AppointmentSubmitted;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class AppointmentController extends Controller
{

    public function store(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'appointment_date' => 'required|date',
            'appointment_time' => 'required',
            'service_id' => 'required|exists:services,id',
            'reason' => 'nullable|string|max:255',
            'patient_signature' => 'nullable|string',
        ]);

        $service = Service::query()
            ->select([
                'id',
                'service_name',
                'duration',
            ])
            ->findOrFail($validated['service_id']);

        $start = Carbon::parse(
            $validated['appointment_date'] . ' ' .
            $validated['appointment_time']
        );

        $end = $start->copy()->addMinutes(
            (int) $service->duration
        );

        $exists = Appointments::query()
            ->where(
                'appointment_date',
                $validated['appointment_date']
            )
            ->where(function ($query) use ($start, $end) {
                $query
                    ->where(
                        'appointment_time',
                        '<',
                        $end->format('H:i:s')
                    )
                    ->where(
                        'end_time',
                        '>',
                        $start->format('H:i:s')
                    );
            })
            ->exists();

        if ($exists) {
            return back()
                ->withInput()
                ->with(
                    'error',
                    'Time slot already booked!'
                );
        }

        $patient = PatientRecords::query()
            ->where(
                'user_id',
                auth()->id()
            )
            ->first();

        if (!$patient) {
            $patient = PatientRecords::create([
                'user_id' => auth()->id(),
                'patient_name' => $validated['full_name'],
            ]);
        }



$signaturePath = null;

if ($request->filled('patient_signature')) {

    $signatureData = $request->input(
        'patient_signature'
    );

    if (
        preg_match(
            '/^data:image\/(\w+);base64,/',
            $signatureData,
            $matches
        )
    ) {

        $extension = $matches[1];

        $base64Image = substr(
            $signatureData,
            strpos(
                $signatureData,
                ','
            ) + 1
        );

        $imageData = base64_decode(
            $base64Image
        );

        if ($imageData !== false) {

            // Delete old signature if it exists

            if (
                $patient->patient_signature &&
                Storage::disk('public')->exists(
                    $patient->patient_signature
                )
            ) {

                Storage::disk('public')->delete(
                    $patient->patient_signature
                );

            }

            // Create new signature filename

            $fileName =
                'signatures/patient-record-' .
                $patient->id .
                '-' .
                time() .
                '.' .
                $extension;

            // Save signature image

            Storage::disk('public')->put(
                $fileName,
                $imageData
            );

            $signaturePath = $fileName;

            // SAVE PATH TO PATIENT RECORD

            $patient->update([
                'patient_signature' => $signaturePath,
            ]);

        }

    }

}

        $appointment = Appointments::create([
            'patient_record_id' => $patient->id,
            'service_id' => $validated['service_id'],
            'appointment_date' => $validated['appointment_date'],
            'appointment_time' => $start->format('H:i:s'),
            'end_time' => $end->format('H:i:s'),
            'reason' => $validated['reason'] ?? null,
            'status' => 'pending',
            'checked_in_at' => null,
            'treatment_started_at' => null,
            'checked_out_at' => null,
        ]);

        $appointment->load([
            'patient.user',
            'service',
        ]);

        // ========================================================
        // NOTIFY PATIENT
        // ========================================================

        if (
            $appointment->patient &&
            $appointment->patient->user
        ) {
            $appointment->patient->user->notify(
                new AppointmentSubmitted($appointment)
            );
        }

        // ========================================================
        // NOTIFY ADMINS
        // ========================================================

        $admins = User::role('admin')->get();

        foreach ($admins as $admin) {
            $admin->notify(
                new AppointmentSubmitted($appointment)
            );
        }

        return back()->with(
            'success',
            'Appointment submitted successfully!'
        );
    }

    // ============================================================
    // UPDATE APPOINTMENT
    // ============================================================

    public function update(
        Request $request,
        $id
    ) {
        $validated = $request->validate([
            'problem_diagnosis' => 'nullable|string|max:1000',
            'status' => [
                'required',
                'in:pending,confirmed,completed,cancelled',
            ],
        ]);

        $appointment = Appointments::query()
            ->with([
                'patient.user',
                'service',
            ])
            ->findOrFail($id);

        $oldStatus = $appointment->status;

        $appointment->update([
            'problem_diagnosis' =>
                $validated['problem_diagnosis'] ?? null,

            'status' =>
                $validated['status'],
        ]);

        $newStatus = $validated['status'];

        // ========================================================
        // STOP IF STATUS DID NOT CHANGE
        // ========================================================

        if ($oldStatus === $newStatus) {
            return back()->with(
                'success',
                'Appointment updated!'
            );
        }

        // ========================================================
        // PATIENT USER
        // ========================================================

        $patientUser = null;

        if (
            $appointment->patient &&
            $appointment->patient->user
        ) {
            $patientUser =
                $appointment->patient->user;
        }

        // ========================================================
        // CONFIRMED
        // ========================================================

        if ($newStatus === 'confirmed') {

            if ($patientUser) {
                $patientUser->notify(
                    new AppointmentApproved(
                        $appointment
                    )
                );
            }

            // Notify receptionists

            $receptionists =
                User::role('receptionist')->get();

            foreach ($receptionists as $receptionist) {
                $receptionist->notify(
                    new AppointmentApproved(
                        $appointment
                    )
                );
            }
        }

        // ========================================================
        // CANCELLED
        // ========================================================

        if ($newStatus === 'cancelled') {

            if ($patientUser) {
                $patientUser->notify(
                    new AppointmentCancelled(
                        $appointment
                    )
                );
            }
        }

        return back()->with(
            'success',
            'Appointment updated successfully!'
        );
    }

    // ============================================================
    // DECLINE APPOINTMENT
    // ============================================================

    public function decline($id)
    {
        $appointment = Appointments::query()
            ->with([
                'patient.user',
                'service',
            ])
            ->findOrFail($id);

        if ($appointment->status !== 'cancelled') {

            $appointment->update([
                'status' => 'cancelled',
            ]);

            if (
                $appointment->patient &&
                $appointment->patient->user
            ) {
                $appointment->patient->user->notify(
                    new AppointmentDeclined(
                        $appointment
                    )
                );
            }
        }

        return back()->with(
            'success',
            'Appointment declined and patient notified.'
        );
    }

    // ============================================================
    // ADMIN APPOINTMENT VIEW
    // ============================================================

    public function index()
    {
        $appointments = Appointments::query()
            ->with([
                'patient',
                'service',
            ])
            ->latest('appointment_date')
            ->latest('appointment_time')
            ->paginate(20);

        return view(
            'admin.appointment.index',
            compact('appointments')
        );
    }

    // ============================================================
    // PATIENT APPOINTMENT HOMEPAGE
    // ============================================================

    public function homepage()
    {
        $userId = auth()->id();

        $patient = PatientRecords::query()
            ->select('id')
            ->where(
                'user_id',
                $userId
            )
            ->first();

        if ($patient) {

            $appointmentHistory =
                Appointments::query()
                    ->where(
                        'patient_record_id',
                        $patient->id
                    )
                    ->with([
                        'service:id,service_name',
                    ])
                    ->select([
                        'id',
                        'patient_record_id',
                        'service_id',
                        'appointment_date',
                        'appointment_time',
                        'doctor_name',
                        'status',
                        'total_amount',
                        'amount_paid',
                        'balance',
                    ])
                    ->latest('appointment_date')
                    ->latest('appointment_time')
                    ->limit(10)
                    ->get();

        } else {

            $appointmentHistory = collect();
        }

        $services = Service::query()
            ->select([
                'id',
                'service_name',
                'duration',
                'price',
            ])
            ->orderBy('service_name')
            ->get();

        $guides = Guide::query()->get();

        return view(
            'appointments.appointment-homepage',
            compact(
                'appointmentHistory',
                'services',
                'guides'
            )
        );
    }

    // ============================================================
    // PATIENT APPOINTMENT HISTORY
    // ============================================================

    public function history(Request $request)
    {
        $user = auth()->user();

        $patient = PatientRecords::query()
            ->select('id')
            ->where(
                'user_id',
                $user->id
            )
            ->first();

        if (!$patient) {

            $appointments = Appointments::query()
                ->whereRaw('1 = 0')
                ->paginate(10);

            $services = Service::query()
                ->select([
                    'id',
                    'service_name',
                ])
                ->orderBy('service_name')
                ->get();

            $doctors = collect();

        } else {

            $query = Appointments::query()
                ->where(
                    'patient_record_id',
                    $patient->id
                )
                ->with([
                    'service:id,service_name',
                ])
                ->select([
                    'id',
                    'patient_record_id',
                    'appointment_date',
                    'appointment_time',
                    'doctor_name',
                    'service_id',
                    'status',
                    'total_amount',
                    'amount_paid',
                    'balance',
                    'payment_status',
                ])
                ->latest('appointment_date')
                ->latest('appointment_time');

            // MONTH FILTER

            if ($request->filled('month')) {

                $month = (int) $request->input('month');

                if ($month >= 1 && $month <= 12) {
                    $query->whereMonth(
                        'appointment_date',
                        $month
                    );
                }
            }

            // DOCTOR FILTER

            if ($request->filled('doctor')) {

                $doctor = trim(
                    $request->input('doctor')
                );

                if ($doctor !== '') {
                    $query->where(
                        'doctor_name',
                        $doctor
                    );
                }
            }

            // SERVICE FILTER

            if ($request->filled('service')) {

                $service = trim(
                    $request->input('service')
                );

                if ($service !== '') {

                    $query->whereHas(
                        'service',
                        function ($serviceQuery) use ($service) {

                            $serviceQuery->where(
                                'service_name',
                                $service
                            );
                        }
                    );
                }
            }

            // STATUS FILTER

            if ($request->filled('status')) {

                $allowedStatuses = [
                    'pending',
                    'confirmed',
                    'completed',
                    'cancelled',
                ];

                $status = $request->input('status');

                if (
                    in_array(
                        $status,
                        $allowedStatuses,
                        true
                    )
                ) {
                    $query->where(
                        'status',
                        $status
                    );
                }
            }

            // SEARCH

            if ($request->filled('search')) {

                $search = trim(
                    $request->input('search')
                );

                if ($search !== '') {

                    $query->where(
                        function ($q) use ($search) {

                            $q->where(
                                'doctor_name',
                                'like',
                                '%' . $search . '%'
                            )
                            ->orWhere(
                                'status',
                                'like',
                                '%' . $search . '%'
                            )
                            ->orWhereHas(
                                'service',
                                function (
                                    $serviceQuery
                                ) use ($search) {

                                    $serviceQuery->where(
                                        'service_name',
                                        'like',
                                        '%' . $search . '%'
                                    );
                                }
                            );
                        }
                    );
                }
            }

            $appointments = $query
                ->paginate(10)
                ->withQueryString();

            $doctors = Appointments::query()
                ->where(
                    'patient_record_id',
                    $patient->id
                )
                ->whereNotNull('doctor_name')
                ->where(
                    'doctor_name',
                    '!=',
                    ''
                )
                ->distinct()
                ->orderBy('doctor_name')
                ->pluck('doctor_name');

            $services = Service::query()
                ->select([
                    'id',
                    'service_name',
                ])
                ->orderBy('service_name')
                ->get();
        }

        // ========================================================
        // NOTIFICATIONS
        // ========================================================

        $notifications = $user
            ->notifications()
            ->latest()
            ->limit(10)
            ->get();

        $notificationCount = $user
            ->notifications()
            ->whereNull('read_at')
            ->count();

        return view(
            'appointments.history',
            compact(
                'appointments',
                'services',
                'doctors',
                'notifications',
                'notificationCount'
            )
        );
    }
}
