<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Odontogram;
class OdontogramController extends Controller
{
    public function store(Request $request)
{

    Odontogram::updateOrCreate(

        [

            'patient_record_id' => $request->patient_record_id,
            'tooth_number'      => $request->tooth_number,

        ],

        [

            'condition' => $request->condition,
            'remarks'   => $request->remarks

        ]

    );

    return response()->json([
        'success' => true
    ]);

}
}
