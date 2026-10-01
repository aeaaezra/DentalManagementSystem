<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Bill;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'bill_id',
        'amount',
        'payment_method',
        'reference_number',
        'payment_date',
        'received_by',
        'remarks',
    ];

    public function bill()
    {
        return $this->belongsTo(Bill::class);
    }
}
