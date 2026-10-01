<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use App\Models\Appointments;
use BackedEnum;
use Filament\Support\Icons\Heroicon;

class AppointmentCalendar extends Page
{
    protected static string|BackedEnum|null $navigationIcon =
        Heroicon::CalendarDays;

    protected  string $view =
        'filament.pages.appointment-calendar';

    public $appointments = [];

    public function mount(): void
    {
        $this->appointments = Appointments::with('patient')
            ->get()
            ->map(function ($appointment) {

                return [

                    'id' => $appointment->id,

                    'date' => $appointment->appointment_date,

                    'time' => date(
                        'h:i A',
                        strtotime($appointment->appointment_time)
                    ),

                    'patient_name' =>
                        $appointment->patient?->patient_name
                        ?? 'No Patient',

                    'tel_no' =>
                        $appointment->patient?->tel_no
                        ?? 'No Number',

                    'reason' =>
                        $appointment->reason ?? 'No Reason',

                    'status' =>
                        $appointment->status ?? 'pending',
                ];
            })
            ->toArray();
    }
}
