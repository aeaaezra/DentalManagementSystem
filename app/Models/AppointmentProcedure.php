<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AppointmentProcedure extends Model
{
    protected $fillable = [
        'appointment_id',
        'service_procedure_id',
        'category_name',
        'procedure_name',
        'pricing_unit',
        'price',
        'duration_minutes',
    ];

    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'duration_minutes' => 'integer',
        ];
    }

    public function appointment(): BelongsTo
    {
        return $this->belongsTo(Appointments::class, 'appointment_id');
    }

    public function serviceProcedure(): BelongsTo
    {
        return $this->belongsTo(ServiceProcedure::class, 'service_procedure_id');
    }
}
