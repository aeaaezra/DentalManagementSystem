<?php

namespace App\Filament\Resources\Users\Schemas;

use App\Models\User;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;
use Spatie\Permission\Models\Role;

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
                    ->revealable()
                    ->required(),

                Select::make('role')
                    ->label('Primary Role')
                    ->helperText('The primary role is retained for compatibility with existing system code.')
                    ->options([
                        'admin' => 'Admin',
                        'dentist' => 'Dentist',
                        'patient' => 'Patient',
                        'customer' => 'Customer',
                        'cashier' => 'Cashier',
                        'staff' => 'Staff',
                        'receptionist' => 'Receptionist',
                    ])
                    ->required()
                    ->native(false),

                Select::make('roles')
                    ->label('Additional Roles / Portal Access')
                    ->helperText('Select every role this account should have. The primary role is included automatically.')
                    ->multiple()
                    ->options(
                        Role::query()
                            ->where('guard_name', 'web')
                            ->orderBy('name')
                            ->pluck('name', 'name')
                            ->all()
                    )
                    ->searchable()
                    ->preload()
                    ->native(false)
                    ->afterStateHydrated(
                        function (Select $component, ?User $record): void {
                            $component->state(
                                $record?->getRoleNames()->all() ?? []
                            );
                        }
                    ),
            ]);
    }
}
