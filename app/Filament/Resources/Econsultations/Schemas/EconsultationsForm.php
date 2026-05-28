<?php

namespace App\Filament\Resources\EConsultations\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class EConsultationsForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('E-Consultation Information')
                ->schema([
                    Select::make('patient_record_id')
                        ->label('Patient')
                        ->relationship('patient', 'patient_name')
                        ->searchable()
                        ->preload()
                        ->required(),

                    Select::make('appointment_id')
                        ->label('Related Appointment')
                        ->relationship('appointment', 'id')
                        ->searchable()
                        ->preload()
                        ->nullable(),

                    Grid::make(3)->schema([
                        DateTimePicker::make('consultation_datetime')
                            ->label('Consultation Schedule')
                            ->seconds(false),

                        Select::make('consultation_type')
                            ->label('Consultation Type')
                            ->options([
                                'chat' => 'Chat',
                                'video_call' => 'Video Call',
                                'phone_call' => 'Phone Call',
                            ])
                            ->default('chat')
                            ->required(),

                        Select::make('status')
                            ->options([
                                'waiting' => 'Waiting',
                                'ongoing' => 'Ongoing',
                                'completed' => 'Completed',
                                'cancelled' => 'Cancelled',
                            ])
                            ->default('waiting')
                            ->required(),
                    ]),
                ]),

            Section::make('Consultation Details')
                ->schema([
                    Textarea::make('chief_complaint')
                        ->label('Chief Complaint')
                        ->rows(3)
                        ->columnSpanFull(),

                    Textarea::make('symptoms')
                        ->label('Symptoms')
                        ->rows(3)
                        ->columnSpanFull(),

                    Textarea::make('first_aid_advice')
                        ->label('First Aid Advice')
                        ->rows(3)
                        ->columnSpanFull(),

                    Textarea::make('consultation_notes')
                        ->label('Consultation Notes')
                        ->rows(4)
                        ->columnSpanFull(),
                ]),
        ]);
    }
}
