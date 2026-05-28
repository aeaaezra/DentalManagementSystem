<?php

namespace App\Filament\Resources\Appointments\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Actions\DeleteAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class AppointmentsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([

                TextColumn::make('patient.patient_name')
                    ->label('Patient Name')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('patient.tel_no')
                    ->label('Contact Number')
                    ->searchable(),

                TextColumn::make('appointment_date')
                    ->label('Date')
                    ->date()
                    ->sortable(),

                TextColumn::make('appointment_time')
                    ->label('Time')
                    ->time()
                    ->sortable(),

                TextColumn::make('reason')
                    ->limit(30)
                    ->searchable(),

                TextColumn::make('status')
                    ->badge()
                    ->colors([
                        'warning' => 'pending',
                        'success' => 'confirmed',
                        'info' => 'completed',
                        'danger' => 'cancelled',
                    ]),

                TextColumn::make('amount')
                    ->money('PHP')
                    ->sortable(),

                TextColumn::make('deposit')
                    ->money('PHP')
                    ->sortable(),

                TextColumn::make('balance')
                    ->money('PHP')
                    ->sortable(),

            ])
            ->filters([

                SelectFilter::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'confirmed' => 'Confirmed',
                        'completed' => 'Completed',
                        'cancelled' => 'Cancelled',
                    ]),

            ])
            ->recordActions([
                EditAction::make(),
                ViewAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
