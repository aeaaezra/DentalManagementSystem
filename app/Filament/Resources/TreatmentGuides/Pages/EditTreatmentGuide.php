<?php

namespace App\Filament\Resources\TreatmentGuides\Pages;

use App\Filament\Resources\TreatmentGuides\TreatmentGuideResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditTreatmentGuide extends EditRecord
{
    protected static string $resource = TreatmentGuideResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
