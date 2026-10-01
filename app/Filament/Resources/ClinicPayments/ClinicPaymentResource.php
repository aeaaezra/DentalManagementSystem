<?php

namespace App\Filament\Resources\ClinicPayments;

use App\Filament\Resources\ClinicPayments\Pages\CreateClinicPayment;
use App\Filament\Resources\ClinicPayments\Pages\EditClinicPayment;
use App\Filament\Resources\ClinicPayments\Pages\ListClinicPayments;
use App\Filament\Resources\ClinicPayments\Pages\ViewClinicPayment;
use App\Filament\Resources\ClinicPayments\Schemas\ClinicPaymentForm;
use App\Filament\Resources\ClinicPayments\Schemas\ClinicPaymentInfolist;
use App\Filament\Resources\ClinicPayments\Tables\ClinicPaymentsTable;
use App\Models\ClinicPayment;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ClinicPaymentResource extends Resource
{
    protected static ?string $model = ClinicPayment::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBanknotes;
    protected static string|UnitEnum|null $navigationGroup = 'Appointments';
    protected static ?string $recordTitleAttribute = 'payment_method';

    public static function form(Schema $schema): Schema
    {
        return ClinicPaymentForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return ClinicPaymentInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ClinicPaymentsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListClinicPayments::route('/'),
            'create' => CreateClinicPayment::route('/create'),
            'view' => ViewClinicPayment::route('/{record}'),
            'edit' => EditClinicPayment::route('/{record}/edit'),
        ];
    }
}
