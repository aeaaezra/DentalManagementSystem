<?php

namespace App\Filament\Resources\PosSaleItems\Pages;

use App\Filament\Resources\PosSaleItems\PosSaleItemsResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditPosSaleItems extends EditRecord
{
    protected static string $resource = PosSaleItemsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
