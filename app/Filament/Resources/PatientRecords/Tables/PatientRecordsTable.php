<?php

namespace App\Filament\Resources\PatientRecords\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class PatientRecordsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('patient_name')
                    ->label('Patient Name')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('age')->sortable(),

                TextColumn::make('sex')->badge(),

                TextColumn::make('contact_number')
                    ->label('Contact Number')
                    ->searchable(),

                TextColumn::make('occupation')->searchable(),

                IconColumn::make('allergy')->boolean(),
                IconColumn::make('diabetes')->boolean(),
                IconColumn::make('hypertension')->boolean(),

                TextColumn::make('appointments_count')
                    ->counts('appointments')
                    ->label('Appointments'),

                TextColumn::make('e_consultations_count')
                    ->counts('eConsultations')
                    ->label('E-Consults'),

                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('sex')
                    ->options([
                        'male' => 'Male',
                        'female' => 'Female',
                    ]),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
