<?php

namespace App\Filament\Widgets;

use App\Models\Products;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;

class ExpiredProducts extends TableWidget
{
    protected static ?string $heading = 'Expired Products';

    protected int | string | array $columnSpan = 2;

    public function table(Table $table): Table
    {
        return $table
            ->query(
                fn (): Builder => Products::query()
                    ->whereDate('expiration_date', '<', now()->toDateString())
                    ->where('quantity', '>', 0)
                    ->orderBy('expiration_date')
            )
            ->columns([
                TextColumn::make('product_name')->label('Product')->searchable()->sortable(),
                TextColumn::make('sku')->label('SKU')->searchable(),
                TextColumn::make('category')->label('Category')->badge()->toggleable(),
                TextColumn::make('quantity')->label('Stock Remaining')->numeric()->badge()->color('danger')->sortable(),
                TextColumn::make('expiration_date')->label('Expired On')->date('M d, Y')->sortable(),
            ])
            ->defaultSort('expiration_date', 'asc')
            ->paginated(['default' => 5, 'pageName' => 'expired-products']);
    }
}
