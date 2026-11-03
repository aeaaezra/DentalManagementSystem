<?php

namespace App\Notifications;

use App\Models\Appointments;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class GuestRescheduleDecision extends Notification
{
    use Queueable;

    public function __construct(
        protected Appointments $appointment,
        protected string $decision,
    ) {}

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        $approved = $this->decision === 'approved';
        $date = $this->appointment->appointment_date
            ? $this->appointment->appointment_date->format('F d, Y')
            : 'Not specified';
        $time = $this->appointment->appointment_time
            ? date('g:i A', strtotime($this->appointment->appointment_time))
            : 'Not specified';
        $name = $this->appointment->patient?->patient_name ?: 'Patient';

        return (new MailMessage)
            ->subject(
                ($approved ? 'Reschedule Request Approved' : 'Reschedule Request Declined')
                . ' - Shine & Smile Dental'
            )
            ->greeting('Hello ' . $name . ',')
            ->line(
                $approved
                    ? 'The clinic has approved your reschedule request. Your appointment has been updated.'
                    : 'The clinic has declined your reschedule request. Your original appointment remains unchanged.'
            )
            ->line('Appointment date: ' . $date)
            ->line('Appointment time: ' . $time)
            ->salutation('Thank you, Shine & Smile Dental');
    }
}
