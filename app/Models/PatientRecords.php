<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Appointments;
use App\Models\Econsultations;

class PatientRecords extends Model
{
    use HasFactory;

    protected $table = 'patient_records';

    protected $fillable = [
        'patient_name',
        'age',
        'sex',
        'civil_status',
        'tel_no',
        'occupation',
        'address',
        'heart_condition',
        'heart_condition_details',
        'allergy',
        'allergy_details',
        'diabetes',
        'diabetes_details',
        'hypertension',
        'hypertension_details',
        'bleeding_tendency',
        'bleeding_tendency_details',
        'asthma',
        'asthma_details',
        'other_diseases_treatments',
        'patient_signature',
    ];

    public function appointments()
    {
        return $this->hasMany(Appointments::class, 'patient_record_id');
    }

    public function eConsultations()
    {
        return $this->hasMany(Econsultations::class, 'patient_record_id');
    }
}
