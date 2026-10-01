<?php

namespace App\Filament\Resources\Services\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class ServiceForm
{
    public static function configure(Schema $schema): Schema
    {
       return $schema
    ->components([

        TextInput::make('service_name')
            ->required(),

        TextInput::make('price')
            ->required()
            ->numeric()
            ->prefix('₱'),

        TextInput::make('duration_minutes')
            ->required()
            ->numeric()
            ->integer()
            ->minValue(1)
            ->suffix('minutes'),

        Textarea::make('description')
            ->default(null)
            ->columnSpanFull(),

    ]);

    }
}
