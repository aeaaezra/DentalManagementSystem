<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClinicPayment extends Model
{
    protected $fillable = [

        'payment_method',
        'account_name',
        'account_number',
        'qr_code',

    ];
}
