<?php

namespace App\Filament\Resources\OrderItems;

use App\Filament\Resources\OrderItems\Pages\CreateOrderItems;
use App\Filament\Resources\OrderItems\Pages\EditOrderItems;
use App\Filament\Resources\OrderItems\Pages\ListOrderItems;
use App\Filament\Resources\OrderItems\Schemas\OrderItemsForm;
use App\Filament\Resources\OrderItems\Tables\OrderItemsTable;
use App\Models\OrderItems;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class OrderItemsResource extends Resource
{
    protected static ?string $model = OrderItems::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-s-clipboard-document-list';

    protected static string|UnitEnum|null $navigationGroup = 'Ordering';

    protected static ?string $navigationLabel = 'Order Items';


    protected static ?string $recordTitleAttribute = 'invoice_no';

    public static function form(Schema $schema): Schema
    {
        return OrderItemsForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return OrderItemsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListOrderItems::route('/'),
            'create' => CreateOrderItems::route('/create'),
            'edit' => EditOrderItems::route('/{record}/edit'),
        ];
    }
}
