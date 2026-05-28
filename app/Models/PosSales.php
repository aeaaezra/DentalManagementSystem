<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PosSales extends Model
{
    protected $table = 'pos_sales';

    protected $fillable = [
        'invoice_no',
        'total_amount',
        'cash_received',
        'change_amount',
        'payment_method',
        'status',
    ];

    protected $casts = [
        'total_amount' => 'decimal:2',
        'cash_received' => 'decimal:2',
        'change_amount' => 'decimal:2',
    ];

    /**
     * Get the items for the sale.
     */
    public function items(): HasMany
    {
        return $this->hasMany(PosSaleItems::class, 'pos_sale_id');
    }
}
