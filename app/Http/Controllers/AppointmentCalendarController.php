<?php

namespace App\Http\Controllers;

use App\Models\Appointments;

class AppointmentCalendarController extends Controller
{
    public function events()
    {
        /*
        |--------------------------------------------------------------------------
        | LOAD APPOINTMENTS WITH PATIENT RECORD
        |--------------------------------------------------------------------------
        */

        $appointments = Appointments::with('patientRecord')->get();

        /*
        |--------------------------------------------------------------------------
        | FORMAT EVENTS FOR CALENDAR
        |--------------------------------------------------------------------------
        */

        $events = $appointments->map(function ($appointment) {

            return [

                /*
                |--------------------------------------------------------------------------
                | EVENT ID
                |--------------------------------------------------------------------------
                */

                'id' => $appointment->id,

                /*
                |--------------------------------------------------------------------------
                | PATIENT NAME
                |--------------------------------------------------------------------------
                */

                'title' => optional($appointment->patientRecord)->patient_name
                    ?? 'Appointment',

                /*
                |--------------------------------------------------------------------------
                | DATE + TIME
                |--------------------------------------------------------------------------
                */

                'start' =>
                    $appointment->appointment_date .
                    'T' .
                    $appointment->appointment_time,

                /*
                |--------------------------------------------------------------------------
                | EXTRA DETAILS
                |--------------------------------------------------------------------------
                */

                'service' => $appointment->reason,

                'status' => $appointment->status,

                'time' => $appointment->appointment_time,

                'date' => $appointment->appointment_date,
            ];
        });

        /*
        |--------------------------------------------------------------------------
        | RETURN JSON
        |--------------------------------------------------------------------------
        */

        return response()->json($events);
    }
}
