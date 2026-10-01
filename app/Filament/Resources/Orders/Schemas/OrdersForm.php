<?php

namespace App\Filament\Resources\Orders\Schemas;

use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class OrdersForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Customer Information')
                ->schema([
                    Grid::make(3)->schema([
                        TextInput::make('order_no')
                            ->label('Order No.')
                            ->required()
                            ->unique(ignoreRecord: true),

                        TextInput::make('customer_name')
                            ->label('Customer Name')
                            ->required(),

                        TextInput::make('contact_number')
                            ->label('Contact Number'),
                    ]),

                    Textarea::make('address')
                        ->rows(2)
                        ->columnSpanFull(),
                ]),

            Section::make('Order Items')
                ->schema([
                    Repeater::make('items')
                        ->relationship()
                        ->schema([
                            Select::make('product_id')
                                ->label('Product')
                                ->relationship('product', 'product_name')
                                ->searchable()
                                ->preload()
                                ->required(),

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
                        ])
                        ->columns(4)
                        ->columnSpanFull(),
                ]),

            Section::make('Payment and Status')
                ->schema([
                    Grid::make(4)->schema([
                        TextInput::make('total_amount')
                            ->numeric()
                            ->prefix('₱')
                            ->required(),

                        Select::make('payment_method')
                            ->options([
                                'cash' => 'Cash',
                                'gcash' => 'GCash',
                                'cod' => 'Cash on Delivery',
                            ])
                            ->default('cod')
                            ->required(),

                        Select::make('payment_status')
                            ->options([
                                'unpaid' => 'Unpaid',
                                'paid' => 'Paid',
                                'refunded' => 'Refunded',
                            ])
                            ->default('unpaid')
                            ->required(),

                        Select::make('status')
                            ->options([
                                'pending' => 'Pending',
                                'approved' => 'Approved',
                                'preparing' => 'Preparing',
                                'completed' => 'Completed',
                                'cancelled' => 'Cancelled',
                            ])
                            ->default('pending')
                            ->required(),
                    ]),
                ]),
        ]);
    }
}
