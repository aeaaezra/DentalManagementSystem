<?php

namespace App\Notifications;

use App\Notifications\Concerns\ChecksNotificationPreferences;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class AppointmentApproved extends Notification
{
    use Queueable;
    use ChecksNotificationPreferences;

    protected $appointment;

    public function __construct($appointment)
    {
        $this->appointment = $appointment;
    }

    public function via(object $notifiable): array
    {
        if (! $this->appointmentNotificationsEnabled($notifiable)) {
            return [];
        }

        return ['database'];
    }

    public function toDatabase(object $notifiable): array
    {
        return [
            'title' => 'Appointment Approved',

            'message' => 'Your dental appointment has been approved by the clinic.',

            'appointment_id' => $this->appointment->id,

            'appointment_date' => $this->appointment->appointment_date
                ? $this->appointment->appointment_date->format('F d, Y')
                : null,

            'appointment_time' => $this->appointment->appointment_time,

            'status' => $this->appointment->status,
        ];
    }
}
