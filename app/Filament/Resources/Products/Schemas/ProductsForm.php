<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\DatePicker;

class ProductsForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('Product Details')
                    ->tabs([
                        Tab::make('General Info')
                            ->schema([
                                Select::make('supplier_id')
                                    ->label('Supplier')
                                    ->relationship('supplier', 'supplier_name')
                                    ->searchable()
                                    ->preload()
                                    ->required(),

                                TextInput::make('sku')
                                    ->label('SKU')
                                    ->required()
                                    ->maxLength(100),

                                TextInput::make('product_name')
                                    ->label('Product Name')
                                    ->required()
                                    ->maxLength(255),

                                TextInput::make('brand_name')
                                    ->label('Brand Name')
                                    ->maxLength(255),

                                TextInput::make('category')
                                    ->label('Category')
                                    ->required()
                                    ->maxLength(255),

                                Textarea::make('description')
                                    ->label('Description')
                                    ->rows(4)
                                    ->columnSpanFull(),
                            ])
                            ->columns(2),

                        Tab::make('Pricing')
                            ->schema([
                                TextInput::make('cost_price')
                                    ->label('Cost Price')
                                    ->numeric()
                                    ->required()
                                    ->prefix('₱'),

                                TextInput::make('selling_price')
                                    ->label('Selling Price')
                                    ->numeric()
                                    ->required()
                                    ->prefix('₱'),
                            ])
                            ->columns(2),

                        Tab::make('Inventory')
                            ->schema([
                                TextInput::make('unit')
                                    ->label('Unit')
                                    ->required()
                                    ->maxLength(100),

                                TextInput::make('quantity')
                                    ->label('Quantity')
                                    ->numeric()
                                    ->required(),

                                TextInput::make('reorder_level')
                                    ->label('Reorder Level')
                                    ->numeric()
                                    ->required(),

                                DatePicker::make('expiration_date')
                                    ->label('Expiration Date')
                                    ->required()
                                    ->displayFormat('Y-m-d'),
                            ])
                            ->columns(2),

                        Tab::make('Media & Status')
                            ->schema([
                                FileUpload::make('image')
                                ->label('Product Image')
                                ->image()
                                ->directory('products')
                                ->nullable(),

                                Toggle::make('is_active')
                                    ->label('Is Active')
                                    ->default(true)
                                    ->required(),
                            ])
                            ->columns(1),
                    ])
                    ->columnSpanFull(),
            ]);
    }
}
