<?php

namespace App\Filament\Widgets;

use App\Models\Products;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;

class LowStockItems extends TableWidget
{
    protected static ?string $heading = 'Low Stock Items';

    protected int | string | array $columnSpan = 2;

    public function table(Table $table): Table
    {
        return $table
            ->query(
                fn (): Builder => Products::query()
                    ->whereColumn('quantity', '<=', 'reorder_level')
                    ->orderBy('quantity')
            )
            ->columns([
                TextColumn::make('product_name')->label('Product')->searchable()->sortable(),
                TextColumn::make('sku')->label('SKU')->searchable(),
                TextColumn::make('quantity')->label('Current Stock')->numeric()->badge()->color('danger')->sortable(),
                TextColumn::make('reorder_level')->label('Reorder Level')->numeric()->sortable(),
                TextColumn::make('category')->label('Category')->badge()->toggleable(),
            ])
            ->defaultSort('quantity', 'asc')
            ->paginated(['default' => 5, 'pageName' => 'low-stock-items']);
    }
}
