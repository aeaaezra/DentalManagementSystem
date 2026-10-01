<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DentistSetting extends Model
{
    use HasFactory;

    // Database table
    protected $table = 'dentist_settings';

    // Mass assignable fields
    protected $fillable = [
        'user_id',
        'appointment_notifications',
        'treatment_notifications',
        'system_notifications',
    ];

    // Convert database values to booleans
    protected $casts = [
        'appointment_notifications' => 'boolean',
        'treatment_notifications' => 'boolean',
        'system_notifications' => 'boolean',
    ];

    // User relationship
    public function user()
    {
        return $this->belongsTo(
            User::class,
            'user_id'
        );
    }
}
