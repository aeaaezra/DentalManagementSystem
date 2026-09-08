<?php

namespace App\Filament\Resources\Reports;

use Filament\Resources\Resource;

class ReportResource extends Resource
{
    protected static bool $shouldRegisterNavigation = false;

    public static function getPages(): array
    {
        return [];
    }
}
