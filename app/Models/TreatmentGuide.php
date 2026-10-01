<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TreatmentGuide extends Model
{
    protected $fillable = [

        'service_id',

        'situation',

        'recommendation',

        'frequency',

        'home_care',

        'foods_to_eat',

        'foods_to_avoid',

        'warning_signs',

    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
