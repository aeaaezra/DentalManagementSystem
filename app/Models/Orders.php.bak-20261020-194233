<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Orders extends Model
{
    protected $table = 'orders';

    protected $fillable = [
        'order_no',
        'customer_name',
        'contact_number',
        'address',
        'total_amount',
        'payment_method',
        'payment_status',
        'status',
    ];

    protected $casts = [
        'total_amount' => 'decimal:2',
    ];

    public function items(): HasMany
    {
        return $this->hasMany(OrderItems::class, 'order_id');
    }
}
