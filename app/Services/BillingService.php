<?php

namespace App\Services;

use App\Models\Bill;
use Illuminate\Support\Str;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;


class BillingService
{

    public function createBill(array $data): Bill
    {
        return Bill::create([
            'invoice_number' => $this->generateInvoiceNumber(),
            'patient_record_id' => $data['patient_record_id'],
            'module' => $data['module'],
            'reference_id' => $data['reference_id'],
            'subtotal' => $data['subtotal'],
            'discount' => $data['discount'] ?? 0,
            'tax' => $data['tax'] ?? 0,
            'total' => $data['total'],
            'amount_paid' => 0,
            'balance' => $data['total'],
            'payment_status' => 'Pending',
            'payment_method' => null,
        ]);
    }

    private function generateInvoiceNumber(): string
    {
        return 'INV-' . now()->format('Y') . '-' . str_pad(
            Bill::count() + 1,
            6,
            '0',
            STR_PAD_LEFT
        );
    }

    public function recordPayment(
    Bill $bill,
    float $amount,
    string $paymentMethod,
    ?string $referenceNumber = null,
    ?string $remarks = null,
): Payment {

    $payment = Payment::create([
        'bill_id' => $bill->id,
        'amount' => $amount,
        'payment_method' => $paymentMethod,
        'reference_number' => $referenceNumber,
        'payment_date' => now(),
        'received_by' => Auth::id(),
        'remarks' => $remarks,
    ]);

    $bill->amount_paid += $amount;

    $bill->balance = max(
        0,
        $bill->total - $bill->amount_paid
    );

    if ($bill->balance <= 0) {

        $bill->payment_status = 'Paid';

    } elseif ($bill->amount_paid > 0) {

        $bill->payment_status = 'Partial';

    }

    $bill->payment_method = $paymentMethod;

    $bill->save();

    return $payment;
}
}
