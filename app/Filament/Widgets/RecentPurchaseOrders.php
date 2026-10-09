<?php

namespace App\Filament\Widgets;

use App\Models\PurchaseOrder;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;

class RecentPurchaseOrders extends TableWidget
{
    protected static ?string $heading = 'Recent Purchase Orders';

    protected int | string | array $columnSpan = 2;

    public function table(Table $table): Table
    {
        return $table
            ->query(
                fn (): Builder => PurchaseOrder::query()
                    ->latest('order_date')
            )
            ->columns([
                TextColumn::make('po_number')
                    ->label('PO Number')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('supplier_id')
                    ->label('Supplier')
                    ->sortable(),

                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->sortable(),

                TextColumn::make('total_amount')
                    ->label('Total')
                    ->money('PHP')
                    ->sortable(),

                TextColumn::make('order_date')
                    ->label('Order Date')
                    ->date('M d, Y')
                    ->sortable(),

                TextColumn::make('expected_date')
                    ->label('Expected')
                    ->date('M d, Y')
                    ->toggleable(),
            ])
            ->defaultSort('order_date', 'desc')
		->paginated([
		    'default' => 5,
		    'pageName' => 'purchase-orders',
		]);    }
}
