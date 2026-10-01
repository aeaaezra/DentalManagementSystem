<?php

namespace App\Filament\Resources\ClinicPayments\Pages;

use App\Filament\Resources\ClinicPayments\ClinicPaymentResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditClinicPayment extends EditRecord
{
    protected static string $resource = ClinicPaymentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
