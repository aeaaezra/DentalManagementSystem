<?php

namespace App\Filament\Resources\PosSaleItems\Pages;

use App\Filament\Resources\PosSaleItems\PosSaleItemsResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPosSaleItems extends ListRecords
{
    protected static string $resource = PosSaleItemsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
