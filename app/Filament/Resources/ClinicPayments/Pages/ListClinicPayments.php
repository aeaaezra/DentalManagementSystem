<?php

namespace App\Filament\Resources\ClinicPayments\Pages;

use App\Filament\Resources\ClinicPayments\ClinicPaymentResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListClinicPayments extends ListRecords
{
    protected static string $resource = ClinicPaymentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
