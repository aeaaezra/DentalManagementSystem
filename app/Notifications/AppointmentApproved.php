<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class AppointmentApproved extends Notification
{
    use Queueable;

    protected $appointment;

    public function __construct($appointment)
    {
        $this->appointment = $appointment;
    }

    /*
    |--------------------------------------------------------------------------
    | IMPORTANT
    |--------------------------------------------------------------------------
    | We are NOT using Laravel's database channel.
    | The notification will be inserted manually into our custom
    | notifications table.
    */

    public function via(object $notifiable): array
    {
        return [];
    }

    public function getData(): array
    {
        return [
            'user_id' => $this->appointment->patient->user_id,

            'title' => 'Appointment Approved',

            'message' =>
                'Your appointment has been approved by the clinic.',

            'is_read' => false,
        ];
    }
}
