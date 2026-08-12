<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Appointments;
use App\Models\Econsultations;
use App\Models\User;
use App\Models\Odontogram;

class PatientRecords extends Model
{
    use HasFactory;

    protected $table = 'patient_records';

    protected $fillable = [
        'user_id',
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
        'other_conditions',
        'patient_signature',
    ];

    public function appointments()
    {
        return $this->hasMany(
            Appointments::class,
            'patient_record_id'
        );
    }

    public function eConsultations()
    {
        return $this->hasMany(
            Econsultations::class,
            'patient_record_id'
        );
    }

    public function user()
    {
        return $this->belongsTo(
            User::class,
            'user_id'
        );
    }

    public function odontograms()
    {
        return $this->hasMany(
            Odontogram::class
        );
    }
}
