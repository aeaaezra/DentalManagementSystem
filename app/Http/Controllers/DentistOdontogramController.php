<?php

namespace App\Http\Controllers;

use App\Models\Odontogram;
use App\Models\PatientRecords;
use Illuminate\Http\Request;

class DentistOdontogramController extends Controller
{
    /**
     * Display the odontogram page.
     */
    public function index(Request $request)
    {
        $patients = PatientRecords::query()
            ->orderBy('patient_name', 'asc')
            ->get();

        $selectedPatient = null;

        if ($request->filled('patient_id')) {
            $selectedPatient = PatientRecords::with('odontograms')
                ->find($request->patient_id);
        }

        return view('dentist.odontogram', [
            'patients' => $patients,
            'selectedPatient' => $selectedPatient,
        ]);
    }

    /**
     * Get a patient's odontogram data.
     */
    public function patient($id)
    {
        $patient = PatientRecords::with('odontograms')
            ->find($id);

        if (!$patient) {
            return response()->json([
                'success' => false,
                'message' => 'Patient not found.',
            ], 404);
        }

        $odontogramData = [];

        foreach ($patient->odontograms as $odontogram) {
            $odontogramData[(string) $odontogram->tooth_number] = [
                'condition' => $odontogram->condition,
                'remarks' => $odontogram->remarks ?? '',
                'updated_at' => $odontogram->updated_at
                    ? $odontogram->updated_at->toDateTimeString()
                    : '',
            ];
        }

        return response()->json([
            'success' => true,
            'patient' => $patient,
            'data' => $odontogramData,
        ]);
    }

    /**
     * Save a patient's odontogram.
     */
    public function save(Request $request)
    {
        $validator = \Illuminate\Support\Facades\Validator::make(
            $request->all(),
            [
                'patient_id' => [
                    'required',
                    'integer',
                    'exists:patient_records,id',
                ],

                'odontogram' => [
                    'required',
                    'array',
                    'min:1',
                ],

                'odontogram.*' => [
                    'required',
                    'array',
                ],

                'odontogram.*.condition' => [
                    'required',
                    'string',
                    \Illuminate\Validation\Rule::in([
                        'healthy',
                        'caries',
                        'filled',
                        'crown',
                        'missing',
                        'root-canal',
                        'extraction',
                        'implant',
                        'fracture',
                        'other',
                    ]),
                ],

                'odontogram.*.remarks' => [
                    'nullable',
                    'string',
                    'max:1000',
                ],
            ]
        );

        $validator->after(function ($validator) use ($request) {
            $allowedTeeth = array_map('strval', array_merge(
                range(11, 18),
                range(21, 28),
                range(31, 38),
                range(41, 48),
                range(51, 55),
                range(61, 65),
                range(71, 75),
                range(81, 85)
            ));

            $odontogram = $request->input('odontogram');

            if (! is_array($odontogram)) {
                return;
            }

            foreach ($odontogram as $toothNumber => $record) {
                if (! in_array((string) $toothNumber, $allowedTeeth, true)) {
                    $validator->errors()->add(
                        "odontogram.{$toothNumber}",
                        'The submitted tooth number is invalid.'
                    );
                }
            }
        });

        $validated = $validator->validate();

        $patientId = $validated['patient_id'];
        $odontogramData = $validated['odontogram'];

        \Illuminate\Support\Facades\DB::transaction(
            function () use ($odontogramData, $patientId) {
                $savedTeeth = [];

                foreach ($odontogramData as $toothNumber => $record) {
                    // Validation above guarantees each record is an array
                    // with a supported condition and valid remarks.
                    $condition = $record['condition'];
                    $remarks = $record['remarks'] ?? '';

                    // Save healthy teeth too, so their condition persists.
                    $savedTeeth[] = (string) $toothNumber;

                    Odontogram::updateOrCreate(
                        [
                            'patient_record_id' => $patientId,
                            'tooth_number' => (string) $toothNumber,
                        ],
                        [
                            'condition' => $condition,
                            'remarks' => $remarks,
                        ]
                    );
                }

                // Do not delete omitted teeth during Save.
                // Use the explicit Clear Chart action for intentional full clearing.
            }
        );

        /*
         * Return the newly saved records.
         */
        $savedRecords = Odontogram::where(
            'patient_record_id',
            $patientId
        )->get();

        $data = [];
        $history = [];

        foreach ($savedRecords as $record) {
            $toothNumber = (string) $record->tooth_number;

            $updatedAt = $record->updated_at
                ? $record->updated_at->toDateTimeString()
                : '';

            $data[$toothNumber] = [
                'condition' => $record->condition,
                'remarks' => $record->remarks ?? '',
                'updated_at' => $updatedAt,
            ];

            $history[] = [
                'tooth' => $toothNumber,
                'condition' => $record->condition,
                'remarks' => $record->remarks ?? '',
                'time' => $updatedAt,
            ];
        }

        return response()->json([
            'success' => true,
            'message' => 'Dental chart saved successfully.',
            'data' => $data,
            'history' => $history,
        ]);
    }

    /**
     * Clear one tooth or the entire odontogram for a patient.
     */
    public function clear(Request $request)
    {
        $validated = $request->validate([
            'patient_id' => [
                'required',
                'integer',
                'exists:patient_records,id',
            ],
            'tooth_number' => [
                'sometimes',
                'required',
                'string',
                \Illuminate\Validation\Rule::in(array_map('strval', array_merge(
                    range(11, 18),
                    range(21, 28),
                    range(31, 38),
                    range(41, 48),
                    range(51, 55),
                    range(61, 65),
                    range(71, 75),
                    range(81, 85)
                ))),
            ],
        ]);

        $query = Odontogram::where(
            'patient_record_id',
            $validated['patient_id']
        );

        if (array_key_exists('tooth_number', $validated)) {
            $query->where(
                'tooth_number',
                $validated['tooth_number']
            )->delete();

            return response()->json([
                'success' => true,
                'message' => 'Tooth ' . $validated['tooth_number'] . ' cleared successfully.',
                'tooth_number' => $validated['tooth_number'],
            ]);
        }

        $query->delete();

        return response()->json([
            'success' => true,
            'message' => 'Dental chart cleared successfully.',
            'data' => [],
            'history' => [],
        ]);
    }
}
