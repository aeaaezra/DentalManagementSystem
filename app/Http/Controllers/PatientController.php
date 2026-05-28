<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Treatment;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function create()
    {
        return view('patients.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'age' => 'nullable|integer',
            'sex' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'tel_no' => 'nullable|string|max:50',
            'civil_status' => 'nullable|string|max:50',
            'blood_pressure' => 'nullable|string|max:50',
            'allergies' => 'nullable|string|max:255',
            'medical_notes' => 'nullable|string',
            'treatments.*.date' => 'nullable|date',
            'treatments.*.diagnosis' => 'nullable|string|max:255',
            'treatments.*.amount' => 'nullable|numeric',
            'treatments.*.payment' => 'nullable|numeric',
            'treatments.*.balance' => 'nullable|numeric',
        ]);

        $patient = Patient::create([
            'name' => $request->name,
            'age' => $request->age,
            'sex' => $request->sex,
            'address' => $request->address,
            'tel_no' => $request->tel_no,
            'civil_status' => $request->civil_status,
            'blood_pressure' => $request->blood_pressure,
            'allergies' => $request->allergies,
            'medical_notes' => $request->medical_notes,
        ]);

        if ($request->has('treatments')) {
            foreach ($request->treatments as $treatment) {
                if (
                    !empty($treatment['date']) ||
                    !empty($treatment['diagnosis']) ||
                    !empty($treatment['amount']) ||
                    !empty($treatment['payment']) ||
                    !empty($treatment['balance'])
                ) {
                    Treatment::create([
                        'patient_id' => $patient->id,
                        'date' => $treatment['date'] ?? null,
                        'diagnosis' => $treatment['diagnosis'] ?? null,
                        'amount' => $treatment['amount'] ?? 0,
                        'payment' => $treatment['payment'] ?? 0,
                        'balance' => $treatment['balance'] ?? 0,
                    ]);
                }
            }
        }

        return redirect()->route('patients.create')->with('success', 'Patient record saved successfully.');
    }
}
