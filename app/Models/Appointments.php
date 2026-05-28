<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PatientRecords;

class Appointments extends Model
{
    use HasFactory;

    protected $table = 'appointments';

    protected $fillable = [
        'patient_record_id',
        'appointment_date',
        'appointment_time',
        'reason',
        'problem_diagnosis',
        'amount',
        'deposit',
        'balance',
        'status',
    ];

    // ✅ FIXED: belongsTo (NOT hasMany)
    public function patient()
    {
        return $this->belongsTo(PatientRecords::class, 'patient_record_id');
    }
}
