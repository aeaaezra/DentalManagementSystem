<?php

namespace App\Filament\Resources\ProductUsages;

use App\Filament\Resources\ProductUsages\Pages\CreateProductUsage;
use App\Filament\Resources\ProductUsages\Pages\EditProductUsage;
use App\Filament\Resources\ProductUsages\Pages\ListProductUsages;
use App\Filament\Resources\ProductUsages\Pages\ViewProductUsage;
use App\Filament\Resources\ProductUsages\Schemas\ProductUsageForm;
use App\Filament\Resources\ProductUsages\Schemas\ProductUsageInfolist;
use App\Filament\Resources\ProductUsages\Tables\ProductUsagesTable;
use App\Models\ProductUsages;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ProductUsageResource extends Resource
{
    protected static ?string $model = ProductUsages::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-s-chart-bar';

    protected static string|UnitEnum|null $navigationGroup = 'Usage';

    protected static ?string $navigationLabel = 'Product Usage';

    protected static ?string $recordTitleAttribute = 'usage_no';

    public static function form(Schema $schema): Schema
    {
        return ProductUsageForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return ProductUsageInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ProductUsagesTable::configure($table);
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
            'index' => ListProductUsages::route('/'),
            'create' => CreateProductUsage::route('/create'),
            'view' => ViewProductUsage::route('/{record}'),
            'edit' => EditProductUsage::route('/{record}/edit'),
        ];
    }
}
