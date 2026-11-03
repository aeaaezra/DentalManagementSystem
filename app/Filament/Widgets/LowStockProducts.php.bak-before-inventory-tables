<?php

namespace App\Filament\Widgets;

use App\Models\Products;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;

class LowStockProducts extends TableWidget
{
    protected static ?string $heading = 'Low Stock Products';

    protected int | string | array $columnSpan = 2;

    public function table(Table $table): Table
    {
        return $table
            ->query(
                fn (): Builder => Products::query()
                    ->whereColumn('quantity', '<=', 'reorder_level')
                    ->orderBy('quantity', 'asc')
            )
            ->columns([
                TextColumn::make('product_name')
                    ->label('Product')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('sku')
                    ->label('SKU')
                    ->searchable()
                    ->toggleable(),

                TextColumn::make('category')
                    ->label('Category')
                    ->badge()
                    ->toggleable(),

                TextColumn::make('quantity')
                    ->label('Stock')
                    ->numeric()
                    ->sortable()
                    ->badge()
                    ->color('danger'),

                TextColumn::make('reorder_level')
                    ->label('Reorder Level')
                    ->numeric()
                    ->sortable(),

                TextColumn::make('expiration_date')
                    ->label('Expiry')
                    ->date('M d, Y')
                    ->toggleable(),
            ])
            ->defaultSort('quantity', 'asc')
->paginated([
    'default' => 5,
    'pageName' => 'low-stock-products',
]);    }
}
