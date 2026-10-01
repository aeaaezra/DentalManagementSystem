<?php

namespace App\Filament\Resources\PatientRecords\Pages;

use App\Filament\Resources\PatientRecords\PatientRecordsResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewPatientRecords extends ViewRecord
{
    protected static string $resource = PatientRecordsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
