<?php

namespace App\Filament\Resources\Appointments\Widgets;

use App\Models\Appointments;
use Carbon\Carbon;
use Filament\Widgets\Widget;

class AppointmentCalendarWidget extends Widget
{
    protected string $view = 'filament.resources.appointments.widgets.appointment-calendar-widget';

    protected int|string|array $columnSpan = 'full';

    public array $appointments = [];

    public function mount(): void
    {
        $this->appointments = Appointments::query()
            ->orderBy('appointment_date')
            ->orderBy('appointment_time')
            ->get()
            ->map(fn ($appointment) => [
                'id' => $appointment->id,
                'patient_name' => $appointment->patient_name,
                'date' => Carbon::parse($appointment->appointment_date)->format('Y-m-d'),
                'time' => Carbon::parse($appointment->appointment_time)->format('h:i A'),
                'status' => $appointment->status ?? 'pending',
                'reason' => $appointment->reason ?? '',
            ])
            ->values()
            ->toArray();
    }
}
