<?php

namespace App\Filament\Resources\ProductUsages\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Actions\DeleteAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

class ProductUsagesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                    TextColumn::make('id')
                    ->sortable(),

                    TextColumn::make('usage_no')
                    ->searchable()
                    ->label('Usage No')
                    ->sortable(),

                    TextColumn::make('used_by')
                    ->searchable()
                    ->label('Used by')
                    ->sortable(),

                    TextColumn::make('patient_id')
                    ->searchable()
                    ->label('Patient ID')
                    ->sortable(),

                    TextColumn::make('appointment_id')
                    ->searchable()
                    ->label('Appointment ID')
                    ->sortable(),

                    TextColumn::make('usage_date')
                    ->searchable()
                    ->label('Usage Date')
                    ->sortable(),

                    TextColumn::make('notes')
                    ->searchable()
                    ->label('Notes')
                    ->sortable(),

                    TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),

                    TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
