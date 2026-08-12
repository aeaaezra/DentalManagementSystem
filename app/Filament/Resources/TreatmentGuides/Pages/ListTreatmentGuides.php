<?php

namespace App\Filament\Resources\TreatmentGuides\Pages;

use App\Filament\Resources\TreatmentGuides\TreatmentGuideResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListTreatmentGuides extends ListRecords
{
    protected static string $resource = TreatmentGuideResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
