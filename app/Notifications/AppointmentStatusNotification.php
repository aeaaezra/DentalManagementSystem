<?php

namespace App\Notifications;

use App\Notifications\Concerns\ChecksNotificationPreferences;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class AppointmentStatusNotification extends Notification
{
    use Queueable;
    use ChecksNotificationPreferences;


    // ============================================================
    // PROPERTIES
    // ============================================================

    protected $status;

    protected $appointmentDate;

    protected $appointment;


    // ============================================================
    // CONSTRUCTOR
    // ============================================================

    public function __construct(
        $status,
        $appointmentDate = null,
        $appointment = null
    ) {

        $this->status =
            $status;

        $this->appointmentDate =
            $appointmentDate;

        $this->appointment =
            $appointment;
    }


    // ============================================================
    // NOTIFICATION CHANNELS
    // ============================================================

    public function via(
        object $notifiable
    ): array {

        // --------------------------------------------------------
        // Check appointment notification preference
        // --------------------------------------------------------

        if (
            !$this->appointmentNotificationsEnabled(
                $notifiable
            )
        ) {

            return [];
        }


        return [
            'database',
        ];
    }


    // ============================================================
    // DATABASE NOTIFICATION
    // ============================================================

    public function toArray(
        object $notifiable
    ): array {

        return [

            'title' =>
                'Appointment Status Updated',

            'message' =>
                'Your dental appointment has been '
                . $this->status
                . '.',

            'status' =>
                $this->status,

            'appointment_date' =>
                $this->appointmentDate,

            'appointment_id' =>
                $this->appointment?->id,
        ];
    }
}
