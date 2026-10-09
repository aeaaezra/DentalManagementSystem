<?php

namespace App\Notifications;

use App\Models\Setting;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class OrderSubmitted extends Notification
{
    use Queueable;

    protected $order;

    public function __construct($order)
    {
        $this->order = $order;
    }

    public function via(object $notifiable): array
    {
        $enabled = Setting::getValue(
            'notification',
            'ordering_alert',
            '1'
        );

        if ((string) $enabled !== '1') {
            return [];
        }

        return [
            'database',
        ];
    }

    public function toDatabase(object $notifiable): array
    {
        return [
            'title' => 'New Order Received',

            'message' =>
                'Customer ' .
                $this->order->customer_name .
                ' placed a new order.',

            'order_id' =>
                $this->order->id,

            'order_no' =>
                $this->order->order_no,

            'customer_name' =>
                $this->order->customer_name,

            'total_amount' =>
                $this->order->total_amount,

            'payment_method' =>
                $this->order->payment_method,

            'status' =>
                $this->order->status,
        ];
    }
}
