<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PatientRecords;
use App\Models\Payment;

class Bill extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_number',
        'patient_record_id',
        'module',
        'reference_id',
        'subtotal',
        'discount',
        'tax',
        'total',
        'amount_paid',
        'balance',
        'payment_status',
        'payment_method',
    ];

    public function patient()
    {
        return $this->belongsTo(PatientRecords::class, 'patient_record_id');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
