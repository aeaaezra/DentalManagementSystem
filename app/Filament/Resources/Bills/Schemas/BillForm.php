<?php

namespace App\Filament\Resources\Bills\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class BillForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('invoice_number')
                    ->required(),
                TextInput::make('patient_record_id')
                    ->numeric()
                    ->default(null),
                Select::make('module')
                    ->options([
            'appointment' => 'Appointment',
            'pos' => 'Pos',
            'ordering' => 'Ordering',
            'econsultation' => 'Econsultation',
        ])
                    ->required(),
                TextInput::make('reference_id')
                    ->required()
                    ->numeric(),
                TextInput::make('subtotal')
                    ->required()
                    ->numeric(),
                TextInput::make('discount')
                    ->required()
                    ->numeric()
                    ->default(0.0),
                TextInput::make('tax')
                    ->required()
                    ->numeric()
                    ->default(0.0),
                TextInput::make('total')
                    ->required()
                    ->numeric(),
                TextInput::make('amount_paid')
                    ->required()
                    ->numeric()
                    ->default(0.0),
                TextInput::make('balance')
                    ->required()
                    ->numeric(),
                Select::make('payment_status')
                    ->options(['Pending' => 'Pending', 'Partial' => 'Partial', 'Paid' => 'Paid'])
                    ->default('Pending')
                    ->required(),
                TextInput::make('payment_method')
                    ->default(null),
            ]);
    }
}
