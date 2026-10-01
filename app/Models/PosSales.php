<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PosSales extends Model
{
    protected $table = 'pos_sales';

    protected $fillable = [
        'invoice_no',
        'cashier_id',
        'patient_id',
        'subtotal',
        'discount',
        'tax',
        'total',
        'amount_paid',
        'change_amount',
        'payment_status',
        'status',
        'notes',
    ];

    protected $casts = [
        'subtotal' => 'decimal:2',
        'discount' => 'decimal:2',
        'tax' => 'decimal:2',
        'total' => 'decimal:2',
        'amount_paid' => 'decimal:2',
        'change_amount' => 'decimal:2',
    ];

    public function items(): HasMany
    {
        return $this->hasMany(
            PosSaleItems::class,
            'pos_sale_id'
        );
    }
}
