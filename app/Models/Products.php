<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Suppliers;

class Products extends Model
{
    protected $table = 'products';

    protected $fillable = [
        'supplier_id',
        'sku',
        'barcode',
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

    public function supplier()
    {
        return $this->belongsTo(Suppliers::class, 'supplier_id');
    }
}
