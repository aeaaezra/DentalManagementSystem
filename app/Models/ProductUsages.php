<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductUsages extends Model
{
    protected $fillable = [
            'usage_no',
            'used_by',
            'patient_id',
            'appointment_id',
            'usage_date',
            'notes',

    ];
}
