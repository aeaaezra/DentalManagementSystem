<?php

namespace App\Filament\Resources\Econsultations\Pages;

use App\Filament\Resources\Econsultations\EconsultationsResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListEconsultations extends ListRecords
{
    protected static string $resource = EconsultationsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
