<?php

namespace App\Filament\Resources\EConsultations\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class EConsultationsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('patient.patient_name')
                    ->label('Patient')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('patient.contact_number')
                    ->label('Contact')
                    ->searchable(),

                TextColumn::make('appointment.id')
                    ->label('Appointment ID')
                    ->placeholder('No appointment'),

                TextColumn::make('consultation_datetime')
                    ->label('Schedule')
                    ->dateTime()
                    ->sortable(),

                TextColumn::make('consultation_type')
                    ->label('Type')
                    ->badge(),

                TextColumn::make('chief_complaint')
                    ->label('Complaint')
                    ->limit(35)
                    ->searchable(),

                TextColumn::make('status')
                    ->badge()
                    ->colors([
                        'warning' => 'waiting',
                        'info' => 'ongoing',
                        'success' => 'completed',
                        'danger' => 'cancelled',
                    ]),
            ])
            ->filters([
                SelectFilter::make('consultation_type')
                    ->options([
                        'chat' => 'Chat',
                        'video_call' => 'Video Call',
                        'phone_call' => 'Phone Call',
                    ]),

                SelectFilter::make('status')
                    ->options([
                        'waiting' => 'Waiting',
                        'ongoing' => 'Ongoing',
                        'completed' => 'Completed',
                        'cancelled' => 'Cancelled',
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
