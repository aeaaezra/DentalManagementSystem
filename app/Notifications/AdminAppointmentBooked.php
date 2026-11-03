<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class AdminAppointmentBooked extends Notification
{
    use Queueable;

    public function __construct(
        protected $appointment
    ) {}

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toDatabase(object $notifiable): array
    {
        return [
            'title' => 'New appointment booked',
            'body' => 'Appointment #' . $this->appointment->id
                . ' has been submitted and is pending approval.',
            'icon' => 'heroicon-o-calendar',
            'format' => 'filament',
            'duration' => 'persistent',
            'appointment_id' => $this->appointment->id,
        ];
    }
}
