<?php

namespace App\Notifications;

use App\Notifications\Concerns\ChecksNotificationPreferences;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\AnonymousNotifiable;

class AppointmentSubmitted extends Notification
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
        if (!$this->appointmentNotificationsEnabled($notifiable)) {
            return [];
        }

        // Guest patients are notified through a routed email address.
        if ($notifiable instanceof AnonymousNotifiable) {
            return ['mail'];
        }

        return ['database', 'mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        $date = $this->appointment->appointment_date
            ? $this->appointment->appointment_date->format('F d, Y')
            : 'Not specified';

        $time = $this->appointment->appointment_time
            ? (string) $this->appointment->appointment_time
            : 'Not specified';

        return (new MailMessage)
            ->subject('Your Appointment Request Is Pending')
            ->greeting('Hello!')
            ->line('We have received your dental appointment request.')
            ->line('Appointment date: ' . $date)
            ->line('Appointment time: ' . $time)
            ->line('Current status: Pending approval')
            ->line('Your appointment is not yet confirmed. Our clinic will review your request and notify you when its status changes.')
            ->salutation('Thank you, Shine & Smile Dental Clinic');
    }

    public function toDatabase(object $notifiable): array
    {
        return [
            'title' => 'Appointment Pending',
            'message' =>
                'Your dental appointment has been submitted and is currently pending approval.',
            'appointment_id' => $this->appointment->id,
            'appointment_date' =>
                $this->appointment->appointment_date
                    ? $this->appointment->appointment_date->format('F d, Y')
                    : null,
            'appointment_time' => $this->appointment->appointment_time,
            'status' => $this->appointment->status,
        ];
    }
}
