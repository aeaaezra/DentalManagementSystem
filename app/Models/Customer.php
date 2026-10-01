<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_code',
        'first_name',
        'last_name',
        'middle_name',
        'phone',
        'email',
        'address',
        'birthdate',
        'gender',
        'is_active',
        'notes'
    ];

    protected $casts = [
        'birthdate' => 'date',
        'is_active' => 'boolean'
    ];

    /*
    |--------------------------------------------------------------------------
    | RELATIONSHIPS
    |--------------------------------------------------------------------------
    */

    // CUSTOMER CARTS
    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    // CUSTOMER SALES
    public function sales()
    {
        return $this->hasMany(PosSales::class, 'customer_id');
    }

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */

    // FULL NAME
    public function getFullNameAttribute()
    {
        return trim(
            $this->first_name . ' ' .
            $this->middle_name . ' ' .
            $this->last_name
        );
    }
}
