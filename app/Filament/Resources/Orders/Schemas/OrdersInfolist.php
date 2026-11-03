<?php

namespace App\Filament\Resources\Orders\Schemas;

use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class OrdersInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Customer Information')
                    ->schema([
                        Grid::make(3)
                            ->schema([
                                TextEntry::make('order_number')
                                    ->label('Order No.')
                                    ->placeholder('—'),

                                TextEntry::make('customer.full_name')
                                    ->label('Customer Name')
                                    ->placeholder('—'),

                                TextEntry::make('contact_number')
                                    ->label('Contact Number')
                                    ->placeholder('—'),

                                TextEntry::make('customer.email')
                                    ->label('Email')
                                    ->placeholder('—'),

                                TextEntry::make('delivery_address')
                                    ->label('Delivery Address')
                                    ->placeholder('—')
                                    ->columnSpan(2),

                                TextEntry::make('order_date')
                                    ->label('Order Date')
                                    ->dateTime()
                                    ->placeholder('—'),
                            ]),
                    ]),

                Section::make('Order Items')
                    ->schema([
                        RepeatableEntry::make('items')
                            ->label('')
                            ->schema([
                                TextEntry::make('product.product_name')
                                    ->label('Product')
                                    ->placeholder('Product unavailable'),

                                TextEntry::make('variant.name')
                                    ->label('Variant')
                                    ->placeholder('Standard'),

                                TextEntry::make('quantity')
                                    ->label('Quantity'),

                                TextEntry::make('unit_price')
                                    ->label('Unit Price')
                                    ->money('PHP'),

                                TextEntry::make('subtotal')
                                    ->label('Subtotal')
                                    ->money('PHP'),
                            ])
                            ->columns(5),
                    ]),

                Section::make('Payment and Status')
                    ->schema([
                        Grid::make(4)
                            ->schema([
                                TextEntry::make('total_amount')
                                    ->label('Total Amount')
                                    ->money('PHP'),

                                TextEntry::make('shipping_fee')
                                    ->label('Shipping Fee')
                                    ->money('PHP'),

                                TextEntry::make('discount_amount')
                                    ->label('Discount')
                                    ->money('PHP'),

                                TextEntry::make('final_amount')
                                    ->label('Final Amount')
                                    ->money('PHP'),

                                TextEntry::make('payment_method')
                                    ->label('Payment Method')
                                    ->badge(),

                                TextEntry::make('payment_status')
                                    ->label('Payment Status')
                                    ->badge(),

                                TextEntry::make('order_status')
                                    ->label('Order Status')
                                    ->badge()
                                    ->color(fn (?string $state): string => match ($state) {
                                        'pending' => 'warning',
                                        'approved' => 'info',
                                        'preparing' => 'gray',
                                        'completed' => 'success',
                                        'cancelled' => 'danger',
                                        default => 'gray',
                                    }),
                            ]),
                    ]),

                Section::make('Additional Notes')
                    ->schema([
                        TextEntry::make('notes')
                            ->placeholder('No additional notes'),
                    ])
                    ->collapsible(),
            ]);
    }
}
