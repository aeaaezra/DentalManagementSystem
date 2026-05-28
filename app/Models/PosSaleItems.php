<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PosSaleItems extends Model
{
    protected $table = 'pos_sale_items';

    protected $fillable = [
        'pos_sale_id',
        'product_id',
        'quantity',
        'price',
        'subtotal',
    ];

    protected $casts = [
        'quantity' => 'integer',
        'price' => 'decimal:2',
        'subtotal' => 'decimal:2',
    ];

    public function sale()
    {
        return $this->belongsTo(PosSales::class, 'pos_sale_id');
    }

    public function product()
    {
        return $this->belongsTo(Products::class, 'product_id');
    }
}
