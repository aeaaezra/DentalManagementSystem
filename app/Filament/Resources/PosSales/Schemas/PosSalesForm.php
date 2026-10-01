<?php

namespace App\Filament\Resources\PosSales\Schemas;

use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class PosSalesForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('POS Sale')
                ->schema([
                    Grid::make(3)->schema([
                        TextInput::make('invoice_no')->required(),

                        Select::make('payment_method')
                            ->options([
                                'cash' => 'Cash',
                                'gcash' => 'GCash',
                                'card' => 'Card',
                            ])
                            ->default('cash'),

                        Select::make('status')
                            ->options([
                                'pending' => 'Pending',
                                'completed' => 'Completed',
                                'cancelled' => 'Cancelled',
                            ])
                            ->default('pending'),
                    ]),
                ]),

            Section::make('Items')
                ->schema([
                    Repeater::make('items')
                        ->relationship()
                        ->schema([
                            Select::make('product_id')
                                ->relationship('product', 'product_name')
                                ->searchable()
                                ->required(),

                            TextInput::make('quantity')->numeric()->default(1),

                            TextInput::make('price')->numeric(),

                            TextInput::make('subtotal')->numeric(),
                        ])
                        ->columns(4),
                ]),

            Section::make('Payment')
                ->schema([
                    Grid::make(3)->schema([
                        TextInput::make('total_amount')->numeric(),

                        TextInput::make('cash_received')->numeric(),

                        TextInput::make('change_amount')->numeric(),
                    ]),
                ]),
        ]);
    }
}
