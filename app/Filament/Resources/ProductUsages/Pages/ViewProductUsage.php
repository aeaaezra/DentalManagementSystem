<?php

namespace App\Filament\Resources\ProductUsages\Pages;

use App\Filament\Resources\ProductUsages\ProductUsageResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewProductUsage extends ViewRecord
{
    protected static string $resource = ProductUsageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
