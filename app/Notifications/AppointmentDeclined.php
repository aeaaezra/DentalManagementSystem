<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class AppointmentDeclined extends Notification
{
    use Queueable;

    protected $appointment;

    public function __construct($appointment)
    {
        $this->appointment = $appointment;
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toDatabase(object $notifiable): array
    {
        return [
            'title' => 'Appointment Declined',

            'message' => 'Your appointment on '
                . $this->appointment->appointment_date
                . ' at '
                . $this->appointment->appointment_time
                . ' was declined.',

            'appointment_id' => $this->appointment->id,

            'doctor' => $this->appointment->doctor_name ?? 'Not assigned',

            'date' => $this->appointment->appointment_date,

            'time' => $this->appointment->appointment_time,

            'type' => 'appointment',
        ];
    }

    public function toArray(object $notifiable): array
    {
        return $this->toDatabase($notifiable);
    }
}
