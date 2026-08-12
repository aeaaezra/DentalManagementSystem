<?php

namespace App\Filament\Widgets;

use App\Models\Appointments;
use App\Models\PatientRecords;
use App\Models\Products;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ClinicStats extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Patients', PatientRecords::count())
                ->description('Registered patients')
                ->color('success'),

            Stat::make('Appointments', Appointments::count())
                ->description('Total appointments')
                ->color('primary'),

            Stat::make('Products', Products::count())
                ->description('Inventory items')
                ->color('warning'),

            Stat::make('Low Stock', Products::where('quantity', '<=', 10)->count())
                ->description('Needs reorder')
                ->color('danger'),
        ];
    }
}
