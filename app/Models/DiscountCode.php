<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DiscountCode extends Model
{
    protected $fillable = [
        'code',
        'type',
        'value',
        'minimum_amount',
        'maximum_discount',
        'usage_limit',
        'used_count',
        'starts_at',
        'expires_at',
        'is_active',
    ];

    protected $casts = [
        'value' => 'decimal:2',
        'minimum_amount' => 'decimal:2',
        'maximum_discount' => 'decimal:2',
        'starts_at' => 'datetime',
        'expires_at' => 'datetime',
        'is_active' => 'boolean',
    ];

    public function isValid(): bool
    {
        if (!$this->is_active) {
            return false;
        }

        if (
            $this->starts_at &&
            now()->lt($this->starts_at)
        ) {
            return false;
        }

        if (
            $this->expires_at &&
            now()->gt($this->expires_at)
        ) {
            return false;
        }

        if (
            $this->usage_limit !== null &&
            $this->used_count >= $this->usage_limit
        ) {
            return false;
        }

        return true;
    }

    public function calculateDiscount(float $subtotal): float
    {
        if ($subtotal < (float) $this->minimum_amount) {
            return 0;
        }

        if ($this->type === 'percentage') {
            $discount = $subtotal * ((float) $this->value / 100);
        } else {
            $discount = (float) $this->value;
        }

        if ($this->maximum_discount !== null) {
            $discount = min(
                $discount,
                (float) $this->maximum_discount
            );
        }

        return min($discount, $subtotal);
    }
}
