<?php

namespace App\Filament\Resources\Appointments\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class AppointmentsForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Appointment Information')
                ->schema([
                    TextInput::make('patient_name')
                        ->required()
                        ->maxLength(255),

                    TextInput::make('tel_no')
                        ->label('Contact Number')
                        ->required()
                        ->maxLength(255),

                    Grid::make(3)->schema([
                        DatePicker::make('appointment_date')
                            ->label('Appointment Date')
                            ->required()
                            ->native(false),

                        TimePicker::make('appointment_time')
                            ->label('Appointment Time')
                            ->seconds(false),

                        Select::make('status')
                            ->options([
                                'pending' => 'Pending',
                                'confirmed' => 'Confirmed',
                                'completed' => 'Completed',
                                'cancelled' => 'Cancelled',
                            ])
                            ->default('pending')
                            ->required(),
                    ]),

                    Textarea::make('reason')
                        ->label('Reason for Appointment')
                        ->rows(2)
                        ->columnSpanFull(),
                ]),

            Section::make('Diagnosis and Payment')
                ->schema([
                    Textarea::make('problem_diagnosis')
                        ->label('Problem / Diagnosis')
                        ->rows(4)
                        ->columnSpanFull(),

                    Grid::make(3)->schema([
                        TextInput::make('amount')
                            ->numeric()
                            ->prefix('₱'),

                        TextInput::make('deposit')
                            ->numeric()
                            ->prefix('₱'),

                        TextInput::make('balance')
                            ->numeric()
                            ->prefix('₱'),
                    ]),
                ]),
        ]);
    }
}
