<?php

namespace App\Http\Controllers;

use App\Models\PatientRecords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;

class DentistPatientRecordController extends Controller
{
    /**
     * Display patient records.
     */
    public function index(Request $request)
    {
        $user = Auth::user();

        /*
        |--------------------------------------------------------------------------
        | Search
        |--------------------------------------------------------------------------
        */

        $search = $request->input('search');

        /*
        |--------------------------------------------------------------------------
        | Patient Records
        |--------------------------------------------------------------------------
        */

        $patients = PatientRecords::query()
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {

                    /*
                    | Search patient name
                    */
                    $q->where(
                        'patient_name',
                        'like',
                        '%' . $search . '%'
                    )

                    /*
                    | Search patient record ID
                    */
                    ->orWhere(
                        'id',
                        $search
                    )

                    /*
                    | Search telephone number
                    */
                    ->orWhere(
                        'tel_no',
                        'like',
                        '%' . $search . '%'
                    );
                });
            })
            ->latest()
            ->paginate(12)
            ->withQueryString();

        /*
        |--------------------------------------------------------------------------
        | Notifications
        |--------------------------------------------------------------------------
        */

        $notificationCount = 0;

        if ($user) {
            $notificationCount = $user
                ->notifications()
                ->whereNull('read_at')
                ->count();
        }

        $notifications = collect();

        if ($user) {
            $notifications = $user
                ->notifications()
                ->latest()
                ->take(5)
                ->get();
        }

        /*
        |--------------------------------------------------------------------------
        | Return View
        |--------------------------------------------------------------------------
        */

        return view(
            'dentist.patient-records',
            [
                'user' => $user,
                'patients' => $patients,
                'notificationCount' => $notificationCount,
                'notifications' => $notifications,
            ]
        );
    }

    /**
     * Display a single patient's complete record as JSON.
     */
    public function show($patient): JsonResponse
    {
        /*
        |--------------------------------------------------------------------------
        | Load Patient
        |--------------------------------------------------------------------------
        |
        | IMPORTANT:
        | odontograms was added because your existing
        | DentistOdontogramController already confirms that
        | PatientRecords has an odontograms relationship.
        |
        */

        $patientRecord = PatientRecords::with([
            'user',
            'appointments',
            'odontograms',
        ])->findOrFail($patient);

        /*
        |--------------------------------------------------------------------------
        | Last Visit
        |--------------------------------------------------------------------------
        */

        $lastVisit = $patientRecord->appointments
            ->whereIn('status', [
                'completed',
                'approved',
            ])
            ->sortByDesc('appointment_date')
            ->first();

        /*
        |--------------------------------------------------------------------------
        | Upcoming Appointment
        |--------------------------------------------------------------------------
        */

        $upcomingAppointment = $patientRecord->appointments
            ->whereIn('status', [
                'approved',
                'confirmed',
            ])
            ->filter(function ($appointment) {

                if (!$appointment->appointment_date) {
                    return false;
                }

                return \Carbon\Carbon::parse(
                    $appointment->appointment_date
                )->isFuture();
            })
            ->sortBy('appointment_date')
            ->first();

        /*
        |--------------------------------------------------------------------------
        | Patient Response
        |--------------------------------------------------------------------------
        */

        return response()->json([
            'success' => true,

            'patient' => [

                /*
                |--------------------------------------------------------------------------
                | Basic Information
                |--------------------------------------------------------------------------
                */

                'id' => $patientRecord->id,

                'patient_name' =>
                    $patientRecord->patient_name,

                'age' =>
                    $patientRecord->age,

                'sex' =>
                    $patientRecord->sex,

                'civil_status' =>
                    $patientRecord->civil_status,

                'tel_no' =>
                    $patientRecord->tel_no,

                'occupation' =>
                    $patientRecord->occupation,

                'address' =>
                    $patientRecord->address,

                'email' =>
                    $patientRecord->user?->email,

                'profile_picture' =>
                    $patientRecord->user?->profile_picture,

                'created_at' =>
                    $patientRecord->created_at,

                /*
                |--------------------------------------------------------------------------
                | Medical History
                |--------------------------------------------------------------------------
                */

                'heart_condition' =>
                    (bool) $patientRecord->heart_condition,

                'heart_condition_details' =>
                    $patientRecord->heart_condition_details,

                'allergy' =>
                    (bool) $patientRecord->allergy,

                'allergy_details' =>
                    $patientRecord->allergy_details,

                'diabetes' =>
                    (bool) $patientRecord->diabetes,

                'diabetes_details' =>
                    $patientRecord->diabetes_details,

                'hypertension' =>
                    (bool) $patientRecord->hypertension,

                'hypertension_details' =>
                    $patientRecord->hypertension_details,

                'bleeding_tendency' =>
                    (bool) $patientRecord->bleeding_tendency,

                'bleeding_tendency_details' =>
                    $patientRecord->bleeding_tendency_details,

                'asthma' =>
                    (bool) $patientRecord->asthma,

                'asthma_details' =>
                    $patientRecord->asthma_details,

                'other_conditions' =>
                    $patientRecord->other_conditions,

                /*
                |--------------------------------------------------------------------------
                | Last Visit
                |--------------------------------------------------------------------------
                */

                'last_visit' => $lastVisit
                    ? [
                        'date' =>
                            $lastVisit->appointment_date,

                        'status' =>
                            $lastVisit->status,
                    ]
                    : null,

                /*
                |--------------------------------------------------------------------------
                | Upcoming Appointment
                |--------------------------------------------------------------------------
                */

                'upcoming_appointment' =>
                    $upcomingAppointment
                        ? [
                            'id' =>
                                $upcomingAppointment->id,

                            'date' =>
                                $upcomingAppointment->appointment_date,

                            'time' =>
                                $upcomingAppointment->appointment_time,

                            'status' =>
                                $upcomingAppointment->status,
                        ]
                        : null,

                /*
                |--------------------------------------------------------------------------
                | Appointments
                |--------------------------------------------------------------------------
                */

                'appointments' =>
                    $patientRecord->appointments,

                /*
                |--------------------------------------------------------------------------
                | Odontogram
                |--------------------------------------------------------------------------
                */

                'odontograms' =>
                    $patientRecord->odontograms,

                /*
                |--------------------------------------------------------------------------
                | Treatment / Prescription / Notes
                |--------------------------------------------------------------------------
                |
                | These remain empty because the controllers you provided
                | do not contain patient-specific treatment-history,
                | prescription, or clinical-note methods.
                |
                */

                'treatments' => [],

                'prescriptions' => [],

                'notes' => [],
            ],
        ]);
    }
}
