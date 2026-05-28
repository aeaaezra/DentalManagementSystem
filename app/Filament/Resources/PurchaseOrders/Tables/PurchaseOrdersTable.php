<?php

namespace App\Filament\Resources\PurchaseOrders\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;

use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

class PurchaseOrdersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->sortable(),

                    TextColumn::make('po_number')
                    ->searchable()
                    ->label('PO Number')
                    ->sortable(),

                    TextColumn::make('supplier_id')
                    ->searchable()
                    ->label('Supplier ID')
                    ->sortable(),

                    TextColumn::make('ordered_by')
                    ->searchable()
                    ->label('Ordered By')
                    ->sortable(),

                    TextColumn::make('order_date')
                    ->searchable()
                    ->label('Order Date')
                    ->sortable(),

                    TextColumn::make('expected_date')
                    ->searchable()
                    ->label('Expected Date')
                    ->sortable(),

                    TextColumn::make('status')
                    ->searchable()
                    ->label('Status')
                    ->sortable(),

                    TextColumn::make('subtotal')
                    ->searchable()
                    ->label('Subtotal')
                    ->sortable(),

                    TextColumn::make('discount_amount')
                    ->searchable()
                    ->label('Discount Amount')
                    ->sortable(),

                    TextColumn::make('tax_amount')
                    ->searchable()
                    ->label('Tax Amount')
                    ->sortable(),

                    TextColumn::make('total_amount')
                    ->searchable()
                    ->label('Total Amount')
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

            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
            ]);
    }
}
