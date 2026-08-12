<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PatientRecords;
use App\Models\Service;

class Appointments extends Model
{
    use HasFactory;

    protected $table = 'appointments';

    protected $fillable = [
        'patient_record_id',
        'service_id',
        'appointment_date',
        'appointment_time',
        'end_time',
        'reason',
        'treatment_summary',
        'amount',
        'deposit',
        'balance',
        'status',
        'total_amount',
        'amount_paid',
        'payment_status',
        'paid_at',
        'diagnosis',
    ];

    public function patient()
    {
        return $this->belongsTo(
            PatientRecords::class,
            'patient_record_id'
        );
    }

    public function service()
    {
        return $this->belongsTo(
            Service::class,
            'service_id'
        );
    }
}
