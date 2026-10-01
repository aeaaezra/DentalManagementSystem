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
                    // IMPORTANT:
                    // Do NOT use bcrypt() here.
                    // The User model's 'hashed' cast
                    // handles the hashing automatically.
                    ,

                Select::make('role')
                    ->label('Role')
                    ->options([
                        'admin' => 'Admin',
                        'staff' => 'Staff',
                        'dentist' => 'Dentist',
                        'patient' => 'Patient',
                        'customer' => 'Customer',
                        'cashier' => 'Cashier',
                        'receptionist' => 'Receptionist',
                    ])
                    ->required()
                    ->native(false),
            ]);
    }
}
