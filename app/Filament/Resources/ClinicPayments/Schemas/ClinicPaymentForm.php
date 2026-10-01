<?php

namespace App\Filament\Resources\ClinicPayments\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ClinicPaymentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Select::make('payment_method')
    ->options([

        'GCash'=>'GCash',
        'Maya'=>'Maya',
        'LandBank'=>'LandBank',

    ])
    ->required(),

TextInput::make('account_name')
    ->required(),

TextInput::make('account_number')
    ->required(),

FileUpload::make('qr_code')
    ->image()
    ->directory('qr_codes')
    ->disk('public')
    ->required(),

            ]);
    }
}
