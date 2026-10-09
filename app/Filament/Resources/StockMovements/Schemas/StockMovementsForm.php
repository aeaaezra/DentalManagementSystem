<?php

namespace App\Filament\Resources\StockMovements\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\DateTimePicker;

class StockMovementsForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('product_id')
                    ->label('Product')
                    ->relationship('product', 'product_name')
                    ->searchable()
                    ->preload()
                    ->required(),

                Select::make('movement_type')
                    ->label('Movement Type')
                    ->options([
                        'in' => 'Stock In',
                        'out' => 'Stock Out',
                        'adjustment' => 'Adjustment',
                        'damaged' => 'Damaged',
                        'expired' => 'Expired',
                        'returned' => 'Returned',
                    ])
                    ->required(),

                Select::make('reference_type')
                    ->label('Reference Type')
                    ->options([
                        'manual' => 'Manual',
                        'order' => 'Order',
                        'purchase' => 'Purchase',
                        'return' => 'Return',
                        'adjustment' => 'Adjustment',
                    ])
                    ->default('manual')
                    ->required(),

                TextInput::make('reference_id')
                    ->label('Reference ID')
                    ->numeric()
                    ->nullable(),

		TextInput::make('quantity')
		    ->label('Quantity / Actual Stock for Adjustment')
		    ->numeric()
		    ->required()
		    ->minValue(1),
		
                TextInput::make('stock_before')
                    ->label('Stock Before')
                    ->numeric()
                    ->disabled()
                    ->dehydrated(),

                TextInput::make('stock_after')
                    ->label('Stock After')
                    ->numeric()
                    ->disabled()
                    ->dehydrated(),

                DateTimePicker::make('movement_date')
                    ->label('Movement Date')
                    ->default(now())
                    ->required(),

                Textarea::make('notes')
                    ->label('Notes / Reason')
                    ->rows(3)
                    ->columnSpanFull(),
            ]);
    }
}
