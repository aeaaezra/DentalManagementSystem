<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'transaction_no',
        'user_id',
        'subtotal',
        'discount',
        'total',
        'payment_method',
        'amount_paid',
        'change_amount',
        'status',
    ];
     public function items()
    {
        return $this->hasMany(TransactionItem::class);
    }



    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
