<?php

namespace App\Filament\Resources\PatientRecords\Schemas;

use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class PatientRecordsForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Patient Information')
                ->schema([
                    Grid::make(3)->schema([
                        TextInput::make('patient_name')
                            ->label('Patient Name')
                            ->required(),

                        TextInput::make('age')
                            ->numeric(),

                        Select::make('sex')
                            ->options([
                                'male' => 'Male',
                                'female' => 'Female',
                            ]),
                    ]),

                    Grid::make(3)->schema([
                        TextInput::make('civil_status')->label('Civil Status'),
                        TextInput::make('contact_number')->label('Contact Number'),
                        TextInput::make('occupation'),
                    ]),

                    Textarea::make('address')
                        ->rows(2)
                        ->columnSpanFull(),
                ]),

            Section::make('Medical History')
                ->schema([
                    Grid::make(2)->schema([
                        Checkbox::make('heart_condition')->label('Heart Condition'),
                        TextInput::make('heart_condition_details')->label('Details'),

                        Checkbox::make('allergy')->label('Allergy'),
                        TextInput::make('allergy_details')->label('Details'),

                        Checkbox::make('diabetes')->label('Diabetes'),
                        TextInput::make('diabetes_details')->label('Details'),

                        Checkbox::make('hypertension')->label('Hypertension'),
                        TextInput::make('hypertension_details')->label('Details'),

                        Checkbox::make('bleeding_tendency')->label('Bleeding Tendency'),
                        TextInput::make('bleeding_tendency_details')->label('Details'),

                        Checkbox::make('asthma')->label('Asthma'),
                        TextInput::make('asthma_details')->label('Details'),
                    ]),

                    Textarea::make('other_conditions')
                        ->label('Other Diseases / Abnormalities & Treatments')
                        ->rows(2)
                        ->columnSpanFull(),
                ]),
        ]);
    }
}
