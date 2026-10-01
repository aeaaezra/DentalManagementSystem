<?php

namespace App\Filament\Resources\StockMovements\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

class StockMovementsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                    TextColumn::make('id')
                ->label('ID')
                ->sortable(),

            TextColumn::make('product.product_name')
                ->label('Product')
                ->searchable()
                ->sortable(),

            TextColumn::make('movement_type')
                ->badge()
                ->color(fn ($state) => match ($state) {
                    'in' => 'success',
                    'out' => 'danger',
                    'adjustment' => 'warning',
                    'damaged' => 'gray',
                    'expired' => 'danger',
                    'returned' => 'info',
                    default => 'secondary',
                }),

            TextColumn::make('reference_type')
                ->label('Reference Type')
                ->badge(),

            TextColumn::make('reference_id')
                ->label('Ref ID'),

            TextColumn::make('quantity')
                ->label('Qty')
                ->sortable(),

            TextColumn::make('stock_before')
                ->label('Before')
                ->sortable(),

            TextColumn::make('stock_after')
                ->label('After')
                ->sortable(),

            TextColumn::make('movement_date')
                ->label('Movement Date')
                ->dateTime()
                ->sortable(),

            TextColumn::make('creator.name')
                ->label('Created By')
                ->sortable(),

            TextColumn::make('created_at')
                ->label('Created At')
                ->dateTime()
                ->toggleable(isToggledHiddenByDefault: true),

            TextColumn::make('updated_at')
                ->label('Updated At')
                ->dateTime()
                ->toggleable(isToggledHiddenByDefault: true),

            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
