<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Odontogram;

class OdontogramController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'patient_record_id' => 'required',
            'tooth_number' => 'required',
            'condition' => 'nullable',
            'remarks' => 'nullable',
        ]);

        $odontogram = Odontogram::updateOrCreate(
            [
                'patient_record_id' => $request->patient_record_id,
                'tooth_number' => $request->tooth_number,
            ],
            [
                'condition' => $request->condition,
                'remarks' => $request->remarks,
            ]
        );

        return response()->json([
            'success' => true,
            'odontogram' => $odontogram,
        ]);
    }

    public function loadPatientChart($patientRecordId)
    {
        try {
            $odontogram = Odontogram::where(
                'patient_record_id',
                $patientRecordId
            )
                ->orderBy('tooth_number')
                ->get();

            return response()->json([
                'success' => true,
                'data' => $odontogram,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Unable to load patient chart.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
