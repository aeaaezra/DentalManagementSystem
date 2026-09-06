<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    protected $table = 'feedback';

    protected $fillable = [
        'user_id',
        'appointment_id',
        'rating',
        'comment',
    ];

    protected $casts = [
        'rating' => 'integer',
    ];


    // APPOINTMENT

    public function appointment()
    {
        return $this->belongsTo(
            Appointments::class,
            'appointment_id'
        );
    }


    // USER

    public function user()
    {
        return $this->belongsTo(
            User::class,
            'user_id'
        );
    }
}
