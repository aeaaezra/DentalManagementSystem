<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Odontogram extends Model
{
    use HasFactory;

    protected $table = 'odontograms';

    protected $fillable = [
        'patient_record_id',
        'tooth_number',
        'condition',
        'remarks',
    ];

    public function patientRecord(): BelongsTo
    {
        return $this->belongsTo(
            PatientRecords::class,
            'patient_record_id',
            'id'
        );
    }
}
