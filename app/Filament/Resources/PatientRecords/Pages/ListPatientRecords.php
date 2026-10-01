<?php

namespace App\Filament\Resources\PatientRecords\Pages;

use App\Filament\Resources\PatientRecords\PatientRecordsResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPatientRecords extends ListRecords
{
    protected static string $resource = PatientRecordsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
