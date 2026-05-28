<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockAdjustments extends Model
{
    protected $fillable = [
        'adjustment_no',
        'adjusted_by',
        'adjustment_date',
        'reason',
        'notes',
    ];
}
