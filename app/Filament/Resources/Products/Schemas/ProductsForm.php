<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
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

                        // =====================================================
                        // GENERAL INFORMATION
                        // =====================================================

                        Tab::make('General Info')
                            ->schema([

                                Select::make('supplier_id')
                                    ->label('Supplier')
                                    ->relationship(
                                        name: 'supplier',
                                        titleAttribute: 'supplier_name'
                                    )
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

                                // =================================================
                                // CATEGORY COMBO BOX
                                // =================================================

                                Select::make('category')
                                    ->label('Category')
                                    ->options([
                                        'Instruments' => 'Instruments',
                                        'Consumables' => 'Consumables',
                                        'Restorative' => 'Restorative',
                                        'Endodontics' => 'Endodontics',
                                        'Orthodontics' => 'Orthodontics',
                                        'Prosthodontics' => 'Prosthodontics',
                                        'Surgical' => 'Surgical',
                                        'Infection Control' => 'Infection Control',
                                        'Equipment' => 'Equipment',
                                        'Oral Care' => 'Oral Care',
                                    ])
                                    ->searchable()
                                    ->native(false)
                                    ->required()
                                    ->placeholder('Select a category'),

                                Textarea::make('description')
                                    ->label('Description')
                                    ->rows(4)
                                    ->columnSpanFull(),

                            ])
                            ->columns(2),


                        // =====================================================
                        // PRICING
                        // =====================================================

                        Tab::make('Pricing')
                            ->schema([

                                TextInput::make('cost_price')
                                    ->label('Cost Price')
                                    ->numeric()
                                    ->required()
                                    ->prefix('₱')
                                    ->minValue(0),

                                TextInput::make('selling_price')
                                    ->label('Selling Price')
                                    ->numeric()
                                    ->required()
                                    ->prefix('₱')
                                    ->minValue(0),

                            ])
                            ->columns(2),



                        Tab::make('Inventory')
                            ->schema([

                                TextInput::make('unit')
                                    ->label('Unit')
                                    ->required()
                                    ->maxLength(100)
                                    ->placeholder('e.g. piece, box, pack'),

                                TextInput::make('quantity')
                                    ->label('Quantity')
                                    ->numeric()
                                    ->required()
                                    ->minValue(0),

                                TextInput::make('reorder_level')
                                    ->label('Reorder Level')
                                    ->numeric()
                                    ->required()
                                    ->minValue(0),

                                DatePicker::make('expiration_date')
                                    ->label('Expiration Date')
                                    ->displayFormat('Y-m-d')
                                    ->native(false)
                                    ->nullable(),

                            ])
                            ->columns(2),


                        Tab::make('Media & Status')
                            ->schema([

                                FileUpload::make('image')
                                    ->label('Product Image')

                                    // Only accept actual image files
                                    ->image()

                                    // Explicit MIME types
                                    ->acceptedFileTypes([
                                        'image/jpeg',
                                        'image/png',
                                        'image/webp',
                                        'image/gif',
                                    ])

                                    // Store inside storage/app/public/products
                                    ->disk('public')
                                    ->directory('products')

                                    // Optional field
                                    ->nullable()

                                    // Allow replacing/deleting the image
                                    ->openable()
                                    ->downloadable()
                                    ->deletable()

                                    // Image preview
                                    ->previewable(true)

                                    // Limit file size to 5 MB
                                    ->maxSize(5120),

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
