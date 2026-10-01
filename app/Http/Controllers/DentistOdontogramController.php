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
        $validated = $request->validate([
            'patient_id' => [
                'required',
                'exists:patient_records,id',
            ],

            'odontogram' => [
                'required',
                'array',
            ],
        ]);

        $patientId = $validated['patient_id'];
        $odontogramData = $validated['odontogram'];

        $savedTeeth = [];

        foreach ($odontogramData as $toothNumber => $record) {
            if (!is_array($record)) {
                continue;
            }

            $condition = $record['condition'] ?? 'healthy';
            $remarks = $record['remarks'] ?? '';

            /*
             * Healthy teeth do not need a database record.
             */
            if ($condition === 'healthy') {
                continue;
            }

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

        /*
         * Delete old teeth that are no longer present
         * in the submitted odontogram.
         */
        $deleteQuery = Odontogram::where(
            'patient_record_id',
            $patientId
        );

        if (!empty($savedTeeth)) {
            $deleteQuery
                ->whereNotIn(
                    'tooth_number',
                    $savedTeeth
                )
                ->delete();
        } else {
            $deleteQuery->delete();
        }

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
     * Clear a patient's odontogram.
     */
    public function clear(Request $request)
    {
        $validated = $request->validate([
            'patient_id' => [
                'required',
                'exists:patient_records,id',
            ],
        ]);

        Odontogram::where(
            'patient_record_id',
            $validated['patient_id']
        )->delete();

        return response()->json([
            'success' => true,
            'message' => 'Dental chart cleared successfully.',
            'data' => [],
            'history' => [],
        ]);
    }
}
