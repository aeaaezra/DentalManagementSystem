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
        'patient_email',
        'service_id',
        'service_category_id',
        'service_procedure_id',
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
        'cancellation_reason',
        'cancellation_details',
        'reschedule_date',
        'reschedule_time',
        'reschedule_end_time',
        'reschedule_reason',
        'late_review_status',
        'late_reviewed_at',
        'late_reviewed_by',
        'late_review_notes',
    ];

    protected $casts = [
        'appointment_date' => 'date',
        'checked_in_at' => 'datetime',
        'treatment_started_at' => 'datetime',
        'checked_out_at' => 'datetime',
        'late_reviewed_at' => 'datetime',
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

    public function serviceCategory()
    {
        return $this->belongsTo(
            ServiceCategory::class,
            'service_category_id',
            'id'
        );
    }

    public function serviceProcedure()
    {
        return $this->belongsTo(
            ServiceProcedure::class,
            'service_procedure_id',
            'id'
        );
    }
    
    public function appointmentProcedures()
{
    return $this->hasMany(
        AppointmentProcedure::class,
        'appointment_id',
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
