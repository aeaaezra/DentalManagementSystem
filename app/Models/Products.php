<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Products extends Model
{
    protected $table = 'products';

    protected $fillable = [
        'supplier_id',
        'sku',
        'product_name',
        'brand_name',
        'category',
        'description',
        'unit',
        'cost_price',
        'selling_price',
        'quantity',
        'reorder_level',
        'expiration_date',
        'image',
        'is_active',
    ];

    protected $casts = [
        'cost_price' => 'decimal:2',
        'selling_price' => 'decimal:2',
        'quantity' => 'integer',
        'reorder_level' => 'integer',
        'expiration_date' => 'date',
        'is_active' => 'boolean',
    ];

    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Suppliers::class, 'supplier_id');
    }

    public function stockMovements(): HasMany
    {
        return $this->hasMany(StockMovements::class, 'product_id');
    }

    public function posSaleItems(): HasMany
    {
        return $this->hasMany(PosSaleItems::class, 'product_id');
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItems::class, 'product_id');
    }
}
