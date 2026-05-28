<?php

namespace App\Filament\Resources\Econsultations\Pages;

use App\Filament\Resources\Econsultations\EconsultationsResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewEconsultations extends ViewRecord
{
    protected static string $resource = EconsultationsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
