<?php

namespace App\Http\Controllers;

use App\Models\PatientRecords;
use App\Models\ServiceCategory;
use App\Models\ServiceProcedure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DentistPatientRecordController extends Controller
{
    /**
     * Display patient records.
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $search = $request->input('search');

        $patients = PatientRecords::query()
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('patient_name', 'like', '%' . $search . '%')
                        ->orWhere('id', $search)
                        ->orWhere('tel_no', 'like', '%' . $search . '%');
                });
            })
            ->latest()
            ->paginate(12)
            ->withQueryString();

        $notificationCount = $user
            ? $user->notifications()->whereNull('read_at')->count()
            : 0;

        $notifications = $user
            ? $user->notifications()->latest()->take(5)->get()
            : collect();

        $categories = ServiceCategory::query()
            ->where('is_active', true)
            ->with([
                'procedures' => fn ($query) => $query
                    ->where('is_active', true)
                    ->orderBy('procedure_name'),
            ])
            ->orderBy('category_name')
            ->get();

        return view('dentist.patient-records', [
            'user' => $user,
            'patients' => $patients,
            'notificationCount' => $notificationCount,
            'notifications' => $notifications,
            'categories' => $categories,
        ]);
    }

    /**
     * Save one or more treatment-history entries for a patient.
     */
    public function storeTreatment(Request $request, $patient): JsonResponse
    {
        $patientRecord = PatientRecords::findOrFail($patient);

        // FDI permanent and primary tooth numbers.
        $validTeeth = [
            '11', '12', '13', '14', '15', '16', '17', '18',
            '21', '22', '23', '24', '25', '26', '27', '28',
            '31', '32', '33', '34', '35', '36', '37', '38',
            '41', '42', '43', '44', '45', '46', '47', '48',
            '51', '52', '53', '54', '55',
            '61', '62', '63', '64', '65',
            '71', '72', '73', '74', '75',
            '81', '82', '83', '84', '85',
        ];

        $validated = $request->validate([
            'treatment_date' => ['required', 'date'],
            'procedures' => ['required', 'array', 'min:1'],
            'procedures.*.service_procedure_id' => [
                'required',
                'integer',
                'exists:service_procedures,id',
            ],
            'procedures.*.tooth_numbers' => ['required', 'array', 'min:1'],
            'procedures.*.tooth_numbers.*' => [
                'required',
                'string',
                'distinct',
                'in:' . implode(',', $validTeeth),
            ],
            'procedures.*.amount' => ['required', 'numeric', 'min:0'],
            'procedures.*.deposit' => ['required', 'numeric', 'min:0'],
        ]);

        foreach ($validated['procedures'] as $index => $procedure) {
            if ((float) $procedure['deposit'] > (float) $procedure['amount']) {
                return response()->json([
                    'success' => false,
                    'message' => 'Deposit cannot be greater than the amount (procedure ' . ($index + 1) . ').',
                ], 422);
            }
        }

        $created = DB::transaction(function () use ($patientRecord, $validated) {
            $records = [];

            foreach ($validated['procedures'] as $procedure) {
                $serviceProcedure = ServiceProcedure::query()
                    ->where('is_active', true)
                    ->findOrFail($procedure['service_procedure_id']);

                $records[] = $patientRecord->patientTreatments()->create([
                    'service_id' => null,
                    'service_procedure_id' => $serviceProcedure->id,
                    'treatment_date' => $validated['treatment_date'],
                    'problem_diagnosis' => $serviceProcedure->procedure_name,
                    'tooth_numbers' => array_values(array_unique(
                        $procedure['tooth_numbers']
                    )),
                    'amount' => $procedure['amount'],
                    'deposit' => $procedure['deposit'],
                    'balance' => (float) $procedure['amount']
                        - (float) $procedure['deposit'],
                ]);
            }

            return $records;
        });

        return response()->json([
            'success' => true,
            'message' => count($created) . ' procedure(s) saved.',
            'treatments' => $created,
        ], 201);
    }

    /**
     * Display a patient's complete record as JSON.
     */
    public function show($patient): JsonResponse
    {
        $patientRecord = PatientRecords::with([
            'user',
            'appointments.service',
            'odontograms',
            'patientTreatments.service',
            'patientTreatments.serviceProcedure',
        ])->findOrFail($patient);

        $lastVisit = $patientRecord->appointments
            ->whereIn('status', ['completed', 'approved'])
            ->sortByDesc('appointment_date')
            ->first();

        $upcomingAppointment = $patientRecord->appointments
            ->whereIn('status', ['approved', 'confirmed'])
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

        return response()->json([
            'success' => true,
            'patient' => [
                'id' => $patientRecord->id,
                'patient_name' => $patientRecord->patient_name,
                'age' => $patientRecord->age,
                'sex' => $patientRecord->sex,
                'civil_status' => $patientRecord->civil_status,
                'tel_no' => $patientRecord->tel_no,
                'occupation' => $patientRecord->occupation,
                'address' => $patientRecord->address,
                'email' => $patientRecord->user?->email,
                'profile_picture' => $patientRecord->user?->profile_picture,
                'patient_signature' => $patientRecord->patient_signature,
                'created_at' => $patientRecord->created_at,

                'heart_condition' => (bool) $patientRecord->heart_condition,
                'heart_condition_details' => $patientRecord->heart_condition_details,
                'allergy' => (bool) $patientRecord->allergy,
                'allergy_details' => $patientRecord->allergy_details,
                'diabetes' => (bool) $patientRecord->diabetes,
                'diabetes_details' => $patientRecord->diabetes_details,
                'hypertension' => (bool) $patientRecord->hypertension,
                'hypertension_details' => $patientRecord->hypertension_details,
                'bleeding_tendency' => (bool) $patientRecord->bleeding_tendency,
                'bleeding_tendency_details' => $patientRecord->bleeding_tendency_details,
                'asthma' => (bool) $patientRecord->asthma,
                'asthma_details' => $patientRecord->asthma_details,
                'other_conditions' => $patientRecord->other_conditions,

                'last_visit' => $lastVisit ? [
                    'date' => $lastVisit->appointment_date,
                    'status' => $lastVisit->status,
                ] : null,

                'upcoming_appointment' => $upcomingAppointment ? [
                    'id' => $upcomingAppointment->id,
                    'date' => $upcomingAppointment->appointment_date,
                    'time' => $upcomingAppointment->appointment_time,
                    'status' => $upcomingAppointment->status,
                ] : null,

                'appointments' => $patientRecord->appointments,
                'odontograms' => $patientRecord->odontograms,

                'treatments' => $patientRecord->patientTreatments
                    ->map(function ($treatment) {
                        $procedureName = $treatment->serviceProcedure?->procedure_name
                            ?? $treatment->service?->service_name
                            ?? $treatment->problem_diagnosis;

                        return [
                            'id' => $treatment->id,
                            'treatment_date' => $treatment->treatment_date?->toDateString(),
                            'date' => $treatment->treatment_date?->toDateString(),
                            'problem_diagnosis' => $treatment->problem_diagnosis,
                            'service_id' => $treatment->service_id,
                            'service_procedure_id' => $treatment->service_procedure_id,
                            'service_name' => $procedureName,
                            'treatment_name' => $procedureName,
                            'name' => $procedureName,
                            'tooth_numbers' => $treatment->tooth_numbers,
                            'amount' => $treatment->amount,
                            'deposit' => $treatment->deposit,
                            'balance' => $treatment->balance,
                        ];
                    })
                    ->values(),

                'prescriptions' => [],
                'notes' => [],
            ],
        ]);
    }
}
