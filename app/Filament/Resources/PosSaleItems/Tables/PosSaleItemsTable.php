<?php

namespace App\Filament\Resources\PosSaleItems\Tables;

use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\BulkActionGroup;

class PosSaleItemsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('sale.invoice_no')
                    ->label('Invoice No.')
                    ->searchable(),

                TextColumn::make('product.product_name')
                    ->label('Product')
                    ->searchable(),

                TextColumn::make('quantity'),

                TextColumn::make('price')
                    ->money('PHP'),

                TextColumn::make('subtotal')
                    ->money('PHP'),

                TextColumn::make('created_at')
                    ->dateTime(),
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
