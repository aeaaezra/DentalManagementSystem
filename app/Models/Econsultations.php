<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Econsultations extends Model
{
    protected $table = 'e_consultations';

    protected $fillable = [
        'patient_record_id',
        'appointment_id',
        'consultation_datetime',
        'chief_complaint',
        'symptoms',
        'first_aid_advice',
        'consultation_notes',
        'consultation_type',
        'status',
    ];

    protected $casts = [
        'consultation_datetime' => 'datetime',
    ];

    public function patient()
    {
        return $this->belongsTo(PatientRecords::class, 'patient_record_id');
    }

    public function appointment()
    {
        return $this->belongsTo(Appointments::class, 'appointment_id');
    }


}
