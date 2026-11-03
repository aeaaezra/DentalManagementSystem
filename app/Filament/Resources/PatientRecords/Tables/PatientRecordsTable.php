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
                TextColumn::make('id')
                    ->label('Record ID')
                    ->sortable(),

                TextColumn::make('patient_name')
                    ->label('Patient Name')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('user_id')
                    ->label('User ID')
                    ->sortable(),

                TextColumn::make('age')
                    ->sortable(),

                TextColumn::make('sex')
                    ->badge()
                    ->color(fn (?string $state): string => match (strtolower($state ?? '')) {
                        'male' => 'info',
                        'female' => 'success',
                        default => 'gray',
                    }),

                TextColumn::make('civil_status')
                    ->label('Civil Status')
                    ->searchable(),

                TextColumn::make('tel_no')
                    ->label('Contact Number')
                    ->searchable()
                    ->copyable(),

                TextColumn::make('occupation')
                    ->searchable(),

                TextColumn::make('address')
                    ->searchable()
                    ->wrap(),

                IconColumn::make('heart_condition')
                    ->label('Heart Condition')
                    ->boolean(),

                TextColumn::make('heart_condition_details')
                    ->label('Heart Condition Details')
                    ->wrap()
                    ->toggleable(),

                IconColumn::make('allergy')
                    ->boolean(),

                TextColumn::make('allergy_details')
                    ->label('Allergy Details')
                    ->wrap()
                    ->toggleable(),

                IconColumn::make('diabetes')
                    ->boolean(),

                TextColumn::make('diabetes_details')
                    ->label('Diabetes Details')
                    ->wrap()
                    ->toggleable(),

                IconColumn::make('hypertension')
                    ->boolean(),

                TextColumn::make('hypertension_details')
                    ->label('Hypertension Details')
                    ->wrap()
                    ->toggleable(),

                IconColumn::make('bleeding_tendency')
                    ->label('Bleeding Tendency')
                    ->boolean(),

                TextColumn::make('bleeding_tendency_details')
                    ->label('Bleeding Tendency Details')
                    ->wrap()
                    ->toggleable(),

                IconColumn::make('asthma')
                    ->boolean(),

                TextColumn::make('asthma_details')
                    ->label('Asthma Details')
                    ->wrap()
                    ->toggleable(),

                TextColumn::make('other_conditions')
                    ->label('Other Conditions')
                    ->wrap()
                    ->toggleable(),

                TextColumn::make('patient_signature')
                    ->label('Patient Signature')
                    ->formatStateUsing(fn ($state): string => filled($state) ? 'Provided' : 'Not provided')
                    ->badge()
                    ->color(fn ($state): string => filled($state) ? 'success' : 'gray')
                    ->toggleable(),

                TextColumn::make('appointments_count')
                    ->counts('appointments')
                    ->label('Appointments')
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label('Created At')
                    ->dateTime()
                    ->sortable(),

                TextColumn::make('updated_at')
                    ->label('Updated At')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(),
            ])
            ->filters([
                SelectFilter::make('sex')
                    ->options([
                        'male' => 'Male',
                        'female' => 'Female',
                    ]),

                SelectFilter::make('civil_status')
                    ->options([
                        'single' => 'Single',
                        'married' => 'Married',
                        'widowed' => 'Widowed',
                        'divorced' => 'Divorced',
                        'separated' => 'Separated',
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
