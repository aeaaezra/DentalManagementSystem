<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CartItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'cart_id',
        'product_id',
        'product_name',
        'price',
        'qty',
        'subtotal'
    ];

    /*
    |--------------------------------------------------------------------------
    | RELATIONSHIPS
    |--------------------------------------------------------------------------
    */

    // CART
    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    // PRODUCT
    public function product()
    {
        return $this->belongsTo(Products::class);
    }

    /*
    |--------------------------------------------------------------------------
    | AUTO SUBTOTAL
    |--------------------------------------------------------------------------
    */

    protected static function booted()
    {
        static::saving(function ($item) {

            $item->subtotal = $item->price * $item->qty;

        });
    }
}
