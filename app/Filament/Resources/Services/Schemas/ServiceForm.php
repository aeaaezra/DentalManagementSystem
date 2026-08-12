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
                TextInput::make('deposit')
                    ->required()
                    ->numeric()
                    ->prefix('₱')
                    ->default(0.0),
                Textarea::make('description')
                    ->default(null)
                    ->columnSpanFull(),

            ]);
    }
}
