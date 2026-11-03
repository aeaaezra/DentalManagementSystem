<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PatientTreatment extends Model
{
    protected $fillable = [
        'patient_record_id',
        'visit_group_id',
        'service_id',
        'service_procedure_id',
        'treatment_date',
        'problem_diagnosis',
        'tooth_numbers',
        'amount',
        'deposit',
        'balance',
    ];

    protected $casts = [
        'treatment_date' => 'date',
        'tooth_numbers' => 'array',
        'amount' => 'decimal:2',
        'deposit' => 'decimal:2',
        'balance' => 'decimal:2',
    ];

    public function patientRecord(): BelongsTo
    {
        return $this->belongsTo(PatientRecords::class, 'patient_record_id');
    }

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class, 'service_id');
    }

    public function serviceProcedure(): BelongsTo
    {
        return $this->belongsTo(ServiceProcedure::class, 'service_procedure_id');
    }
}
