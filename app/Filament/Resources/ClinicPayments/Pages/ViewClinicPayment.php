<?php

namespace App\Filament\Resources\ClinicPayments\Pages;

use App\Filament\Resources\ClinicPayments\ClinicPaymentResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewClinicPayment extends ViewRecord
{
    protected static string $resource = ClinicPaymentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
