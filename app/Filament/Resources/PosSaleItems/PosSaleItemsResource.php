<?php

namespace App\Filament\Resources\PosSaleItems;

use App\Filament\Resources\PosSaleItems\Pages\CreatePosSaleItems;
use App\Filament\Resources\PosSaleItems\Pages\EditPosSaleItems;
use App\Filament\Resources\PosSaleItems\Pages\ListPosSaleItems;
use App\Filament\Resources\PosSaleItems\Schemas\PosSaleItemsForm;
use App\Filament\Resources\PosSaleItems\Tables\PosSaleItemsTable;
use App\Models\PosSaleItems;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class PosSaleItemsResource extends Resource
{
    protected static ?string $model = PosSaleItems::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-s-squares-2x2';

    protected static string|UnitEnum|null $navigationGroup = 'POS';

    protected static ?string $navigationLabel = 'POS Sale Items';


    protected static ?string $recordTitleAttribute = 'product_id';

    public static function form(Schema $schema): Schema
    {
        return PosSaleItemsForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PosSaleItemsTable::configure($table);
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
            'index' => ListPosSaleItems::route('/'),
            'create' => CreatePosSaleItems::route('/create'),
            'edit' => EditPosSaleItems::route('/{record}/edit'),
        ];
    }
}
