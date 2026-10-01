<?php

namespace App\Filament\Resources\ProductUsages\Schemas;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TextArea;
use Filament\Schemas\Schema;

class ProductUsageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
            TextInput::make('usage_no')
            ->label('Usage No')
            ->required(),

            TextInput::make('used_by')
            ->required()
            ->label('Used by')
            ->numeric(),

            TextInput::make('patient_id')
            ->required()
            ->label('Patient ID')
            ->numeric(),

            TextInput::make('appointment_id')
            ->required()
            ->label('Appointment ID')
            ->numeric(),

            DateTimePicker::make('date_time')
            ->label('Date Time')->required()
            ->native(false)
            ->displayFormat('d/mm/yy H:i:s'),

             TextArea::make('notes')
             ->label('Notes')
            ->required(),


            ]);
    }
}
