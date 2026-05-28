<?php

namespace App\Filament\Resources\StockMovements;

use App\Filament\Resources\StockMovements\Pages\CreateStockMovements;
use App\Filament\Resources\StockMovements\Pages\EditStockMovements;
use App\Filament\Resources\StockMovements\Pages\ListStockMovements;
use App\Filament\Resources\StockMovements\Pages\ViewStockMovements;
use App\Filament\Resources\StockMovements\Schemas\StockMovementsForm;
use App\Filament\Resources\StockMovements\Schemas\StockMovementsInfolist;
use App\Filament\Resources\StockMovements\Tables\StockMovementsTable;
use App\Models\StockMovements;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class StockMovementsResource extends Resource
{
    protected static ?string $model = StockMovements::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-arrows-right-left';

    protected static string|UnitEnum|null $navigationGroup = 'Inventory';

    protected static ?string $navigationLabel = 'Stock Movement';

    protected static ?string $recordTitleAttribute = 'id';

    public static function form(Schema $schema): Schema
    {
        return StockMovementsForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return StockMovementsInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return StockMovementsTable::configure($table);
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
            'index' => ListStockMovements::route('/'),
            'create' => CreateStockMovements::route('/create'),
            'view' => ViewStockMovements::route('/{record}'),
            'edit' => EditStockMovements::route('/{record}/edit'),
        ];
    }
}
