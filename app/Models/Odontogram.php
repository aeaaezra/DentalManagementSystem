<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Odontogram extends Model
{
    protected $fillable = [

        'patient_record_id',
        'tooth_number',
        'condition',
        'remarks'

    ];

    public function patient()
    {
        return $this->belongsTo(PatientRecords::class);
    }
}
