<?php

namespace App\Filament\Resources\TreatmentGuides\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class TreatmentGuideForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('service_id')
                    ->required()
                    ->numeric(),
                TextInput::make('situation')
                    ->required(),
                TextInput::make('recommendation')
                    ->required(),
                TextInput::make('frequency')
                    ->required(),
                Textarea::make('home_care')
                    ->required()
                    ->columnSpanFull(),
                Textarea::make('foods_to_eat')
                    ->default(null)
                    ->columnSpanFull(),
                Textarea::make('foods_to_avoid')
                    ->default(null)
                    ->columnSpanFull(),
                Textarea::make('warning_signs')
                    ->default(null)
                    ->columnSpanFull(),
            ]);
    }
}
