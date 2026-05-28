<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'cashier_id',
        'customer_id',
        'status'
    ];

    /*
    |--------------------------------------------------------------------------
    | RELATIONSHIPS
    |--------------------------------------------------------------------------
    */

    // CASHIER
    public function cashier()
    {
        return $this->belongsTo(User::class, 'cashier_id');
    }

    // CUSTOMER
    public function customer()
{
    return $this->belongsTo(Customer::class, 'customer_id');
}

    // CART ITEMS
    public function items()
    {
        return $this->hasMany(CartItem::class);
    }

    /*
    |--------------------------------------------------------------------------
    | HELPERS
    |--------------------------------------------------------------------------
    */

    // TOTAL ITEMS
    public function totalItems()
    {
        return $this->items()->sum('qty');
    }

    // SUBTOTAL
    public function subtotal()
    {
        return $this->items()->sum('subtotal');
    }

    // TAX
    public function tax()
    {
        return $this->subtotal() * 0.12;
    }

    // FINAL TOTAL
    public function total()
    {
        return $this->subtotal() + $this->tax();
    }
}
