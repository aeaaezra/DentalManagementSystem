<?php

namespace App\Filament\Resources\Appointments\Pages;

use App\Filament\Resources\Appointments\AppointmentsResource;
use Filament\Resources\Pages\Page;

class Calendar extends Page
{
    protected static string $resource = AppointmentsResource::class;

    protected string $view = 'filament.resources.appointments.pages.calendar';

    public static function canAccess(array $parameters = []): bool
    {
        return true;
    }
}
