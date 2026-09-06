<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'doctor_name',
        'problem_diagnosis',
        'amount',
        'deposit',
        'balance',
        'total_amount',
        'amount_paid',
        'payment_method',
        'reference_number',
        'receipt',
        'payment_status',
        'paid_at',
        'status',
        'checked_in_at',
        'treatment_started_at',
        'checked_out_at',
    ];

    protected $casts = [
        'appointment_date' => 'date',
        'checked_in_at' => 'datetime',
        'treatment_started_at' => 'datetime',
        'checked_out_at' => 'datetime',
        'paid_at' => 'datetime',

        'amount' => 'decimal:2',
        'deposit' => 'decimal:2',
        'balance' => 'decimal:2',
        'total_amount' => 'decimal:2',
        'amount_paid' => 'decimal:2',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function patient()
    {
        return $this->belongsTo(
            PatientRecords::class,
            'patient_record_id',
            'id'
        );
    }

    public function service()
    {
        return $this->belongsTo(
            Service::class,
            'service_id',
            'id'
        );
    }

    public function feedback()
    {
        return $this->hasOne(
            Feedback::class,
            'appointment_id',
            'id'
        );
    }
}
