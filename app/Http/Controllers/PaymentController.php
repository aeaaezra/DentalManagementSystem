<?php

namespace App\Http\Controllers;

use App\Models\Appointments;
use App\Services\XenditService;

class PaymentController extends Controller
{
    public function test(XenditService $xendit)
    {
        dd('TEST METHOD', $xendit);
    }

    public function create(Appointments $appointment)
    {
        dd('CREATE METHOD', $appointment);
    }
}


