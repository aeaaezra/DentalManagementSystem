<?php

namespace App\Filament\Resources\PurchaseOrders\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;

class PurchaseOrderForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
            TextInput::make('po_number')
            ->required()
            ->label('Purchase Order Number')
            ->numeric(),

            TextInput::make('supplier_id')
            ->required()
            ->label('Supplier ID')
            ->numeric(),

            TextInput::make('ordered_by')
            ->required()
            ->label('Ordered By')
            ->numeric(),

            DatePicker::make('order_date')
            ->label('Order Date')->required()
            ->native(false)
            ->displayFormat('d/mm/yy'),

            DatePicker::make('expected_date')
            ->label('Expected Date')->required()
            ->native(false)
            ->displayFormat('d/mm/yy'),

            Select::make('status')
            ->options([
            'Draft' => 'Draft',
            'Pending' => 'Pending',
            'Approved' => 'Approved',
            'Partially_record' => 'Partially record',
            ])->label('Status')
            ->required()
            ->native(false),

            TextInput::make('subtotal')
            ->required()
            ->label('Subtotal')
            ->numeric(),

            TextInput::make('discount_amount')
            ->required()
            ->label('Discount Amount')
            ->numeric(),

            TextInput::make('tax_amount')
            ->required()
            ->label('Tax Amount')
            ->numeric(),

            TextInput::make('total_amount')
            ->required()
            ->label('Total Amount')
            ->numeric(),

            TextInput::make('note')
            ->required()
            ->label('Notes'),

            ]);
    }
}
