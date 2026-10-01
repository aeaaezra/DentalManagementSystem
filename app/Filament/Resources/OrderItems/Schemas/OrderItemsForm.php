<?php

namespace App\Filament\Resources\OrderItems\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class OrderItemsForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Order Item Information')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                Select::make('order_id')
                                    ->label('Order')
                                    ->relationship('order', 'order_no')
                                    ->searchable()
                                    ->preload()
                                    ->required(),

                                Select::make('product_id')
                                    ->label('Product')
                                    ->relationship('product', 'product_name')
                                    ->searchable()
                                    ->preload()
                                    ->required(),
                            ]),

                        Grid::make(3)
                            ->schema([
                                TextInput::make('quantity')
                                    ->numeric()
                                    ->default(1)
                                    ->required(),

                                TextInput::make('price')
                                    ->numeric()
                                    ->prefix('₱')
                                    ->required(),

                                TextInput::make('subtotal')
                                    ->numeric()
                                    ->prefix('₱')
                                    ->required(),
                            ]),
                    ]),
            ]);
    }
}
