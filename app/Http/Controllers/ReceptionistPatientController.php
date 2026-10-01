<?php

namespace App\Http\Controllers;

use App\Models\PatientRecords;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Carbon\Carbon;

class ReceptionistPatientController extends Controller
{
    /**
     * Display patients.
     */
    public function index(Request $request)
    {
        $search = trim(
            $request->input('search', '')
        );

        $patients = PatientRecords::query()

            ->with([
                'appointments' => function ($query) {

                    $query
                        ->with('service')
                        ->orderBy(
                            'appointment_date',
                            'desc'
                        )
                        ->orderBy(
                            'appointment_time',
                            'desc'
                        );

                },
            ])

            ->when(
                $search !== '',
                function ($query) use ($search) {

                    $query->where(
                        'patient_name',
                        'like',
                        '%' . $search . '%'
                    );

                }
            )

            ->orderBy(
                'patient_name',
                'asc'
            )

            ->paginate(10)

            ->withQueryString();


        return view(
            'receptionist.patients.index',
            compact(
                'patients',
                'search'
            )
        );
    }


    /**
     * Display one patient's information.
     */
    public function show(
        PatientRecords $patient
    ): JsonResponse {

        $patient->load([
            'appointments' => function ($query) {

                $query
                    ->with('service')
                    ->orderBy(
                        'appointment_date',
                        'desc'
                    )
                    ->orderBy(
                        'appointment_time',
                        'desc'
                    );

            },
        ]);


        $appointments =
            $patient->appointments->map(
                function ($appointment) {

                    return [

                        'id' =>
                            $appointment->id,

                        'date' =>
                            $appointment->appointment_date
                                ? $appointment
                                    ->appointment_date
                                    ->format('F d, Y')
                                : 'N/A',

                        'time' =>
                            $appointment->appointment_time
                                ? Carbon::parse(
                                    $appointment
                                        ->appointment_time
                                )->format('h:i A')
                                : 'N/A',

                        'service' =>
                            $appointment
                                ->service
                                ?->service_name
                            ?? 'N/A',

                        'status' =>
                            ucfirst(
                                str_replace(
                                    '_',
                                    ' ',
                                    strtolower(
                                        $appointment
                                            ->status
                                        ?? 'unknown'
                                    )
                                )
                            ),

                        'checked_in_at' =>
                            $appointment
                                ->checked_in_at
                                ? $appointment
                                    ->checked_in_at
                                    ->format(
                                        'M d, Y h:i A'
                                    )
                                : null,

                        'treatment_started_at' =>
                            $appointment
                                ->treatment_started_at
                                ? $appointment
                                    ->treatment_started_at
                                    ->format(
                                        'M d, Y h:i A'
                                    )
                                : null,

                        'checked_out_at' =>
                            $appointment
                                ->checked_out_at
                                ? $appointment
                                    ->checked_out_at
                                    ->format(
                                        'M d, Y h:i A'
                                    )
                                : null,

                    ];
                }
            );


        return response()->json([

            'success' => true,

            'patient' => [

                'id' =>
                    $patient->id,

                'name' =>
                    $patient->patient_name
                    ?? 'Unknown Patient',

                'age' =>
                    $patient->age,

                'sex' =>
                    $patient->sex,

                'civil_status' =>
                    $patient->civil_status,

                'tel_no' =>
                    $patient->tel_no,

                'occupation' =>
                    $patient->occupation,

                'address' =>
                    $patient->address,

                'heart_condition' =>
                    $patient->heart_condition,

                'heart_condition_details' =>
                    $patient->heart_condition_details,

                'allergy' =>
                    $patient->allergy,

                'allergy_details' =>
                    $patient->allergy_details,

                'diabetes' =>
                    $patient->diabetes,

                'diabetes_details' =>
                    $patient->diabetes_details,

                'hypertension' =>
                    $patient->hypertension,

                'hypertension_details' =>
                    $patient->hypertension_details,

                'bleeding_tendency' =>
                    $patient->bleeding_tendency,

                'bleeding_tendency_details' =>
                    $patient->bleeding_tendency_details,

                'asthma' =>
                    $patient->asthma,

                'asthma_details' =>
                    $patient->asthma_details,

                'other_conditions' =>
                    $patient->other_conditions,

            ],

            'appointments' =>
                $appointments,

        ]);
    }


    /**
     * Store a new patient.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([

            'patient_name' => [
                'required',
                'string',
                'max:255',
            ],

            'age' => [
                'nullable',
                'integer',
                'min:0',
                'max:150',
            ],

            'sex' => [
                'nullable',
                'string',
                'max:50',
            ],

            'civil_status' => [
                'nullable',
                'string',
                'max:50',
            ],

            'tel_no' => [
                'nullable',
                'string',
                'max:50',
            ],

            'occupation' => [
                'nullable',
                'string',
                'max:255',
            ],

            'address' => [
                'nullable',
                'string',
                'max:500',
            ],

        ]);


        PatientRecords::create($validated);


        return redirect()
            ->route(
                'receptionist.patients.index'
            )
            ->with(
                'success',
                'Patient added successfully.'
            );
    }
}
