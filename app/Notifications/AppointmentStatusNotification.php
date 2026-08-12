<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AppointmentStatusNotification extends Notification
{
    use Queueable;

    protected $status;
    protected $appointmentDate;
    protected $appointment;

    public function __construct($status, $appointmentDate = null, $appointment = null)
    {
        $this->status = $status;
        $this->appointmentDate = $appointmentDate;
        $this->appointment = $appointment;
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toArray(object $notifiable): array
    {
        return [
            'title' => 'Appointment Status Updated',

            'message' => 'Your dental appointment has been '
                . $this->status
                . '.',

            'status' => $this->status,

            'appointment_date' => $this->appointmentDate,

            'appointment_id' => $this->appointment?->id,
        ];
    }
}
