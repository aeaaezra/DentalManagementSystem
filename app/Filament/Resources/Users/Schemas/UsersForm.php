<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;

class UsersForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                TextInput::make('name')
                    ->label('Name')
                    ->required(),

                TextInput::make('email')
                    ->label('Email')
                    ->email()
                    ->required(),

                TextInput::make('password')
                    ->label('Password')
                    ->password()
                    ->required()
                    ->dehydrateStateUsing(fn ($state) => bcrypt($state)),

                Select::make('role')
                    ->label('Role')
                    ->options([
                        'Admin' => 'Admin',
                        'Staff' => 'Staff',
                        'Dentist' => 'Dentist',
                        'Patient' => 'Patient',
                        'Customer' => 'Customer',
                        'Cashier' => 'Cashier',

                    ])

                    ->required()
                    ->native(false),
            ]);
    }
}
