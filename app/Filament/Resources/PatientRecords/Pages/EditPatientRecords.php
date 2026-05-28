<?php

namespace App\Filament\Resources\PatientRecords\Pages;

use App\Filament\Resources\PatientRecords\PatientRecordsResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditPatientRecords extends EditRecord
{
    protected static string $resource = PatientRecordsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];
    }
}
