<?php

namespace App\Filament\Resources\DiscountCodes\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class DiscountCodeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Promo Code')
                    ->description('Create and configure a discount or promotional code.')
                    ->schema([
                        TextInput::make('code')
                            ->label('Promo Code')
                            ->required()
                            ->maxLength(50)
                            ->unique(ignoreRecord: true)
                            ->placeholder('e.g. SAVE10')
                            ->helperText('Customers will enter this code during checkout.'),

                        Select::make('type')
                            ->label('Discount Type')
                            ->options([
                                'percentage' => 'Percentage',
                                'fixed' => 'Fixed Amount',
                            ])
                            ->required()
                            ->default('percentage')
                            ->live(),

                        TextInput::make('value')
                            ->label('Discount Value')
                            ->numeric()
                            ->required()
                            ->minValue(0)
                            ->prefix(fn ($get) => $get('type') === 'fixed' ? '₱' : '')
                            ->suffix(fn ($get) => $get('type') === 'percentage' ? '%' : '')
                            ->helperText('For example: 10 for 10% or 100 for ₱100.'),

                        TextInput::make('minimum_amount')
                            ->label('Minimum Purchase')
                            ->numeric()
                            ->required()
                            ->default(0)
                            ->minValue(0)
                            ->prefix('₱')
                            ->helperText('Set to ₱0 if there is no minimum purchase.'),

                        TextInput::make('maximum_discount')
                            ->label('Maximum Discount')
                            ->numeric()
                            ->minValue(0)
                            ->prefix('₱')
                            ->nullable()
                            ->helperText('Optional. Useful for percentage discounts.'),

                        TextInput::make('usage_limit')
                            ->label('Usage Limit')
                            ->numeric()
                            ->integer()
                            ->minValue(1)
                            ->nullable()
                            ->helperText('Leave empty for unlimited usage.'),

                        DateTimePicker::make('starts_at')
                            ->label('Starts At')
                            ->seconds(false)
                            ->nullable(),

                        DateTimePicker::make('expires_at')
                            ->label('Expires At')
                            ->seconds(false)
                            ->nullable(),

                        Toggle::make('is_active')
                            ->label('Active')
                            ->default(true)
                            ->helperText('Turn this off to temporarily disable the promo code.'),
                    ])
                    ->columns(2),
            ]);
    }
}
