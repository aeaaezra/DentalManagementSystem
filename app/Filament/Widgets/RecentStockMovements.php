<?php

namespace App\Filament\Widgets;

use App\Models\StockMovements;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;

class RecentStockMovements extends TableWidget
{
    protected static ?string $heading = 'Recent Stock Movements';

    protected int | string | array $columnSpan = 2;

    public function table(Table $table): Table
    {
        return $table
            ->query(
                fn (): Builder => StockMovements::query()
                    ->with(['product', 'creator'])
                    ->latest('movement_date')
            )
            ->columns([
                TextColumn::make('product.product_name')
                    ->label('Product')
                    ->searchable()
                    ->placeholder('Unknown Product'),

                TextColumn::make('movement_type')
                    ->label('Type')
                    ->badge(),

                TextColumn::make('quantity')
                    ->label('Quantity')
                    ->numeric(),

                TextColumn::make('stock_after')
                    ->label('Stock After')
                    ->numeric(),

                TextColumn::make('movement_date')
                    ->label('Date')
                    ->dateTime('M d, Y h:i A'),
            ])
            ->defaultSort('movement_date', 'desc')
            ->paginated(false);
    }
}
