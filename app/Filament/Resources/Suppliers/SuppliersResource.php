<?php

namespace App\Filament\Resources\Suppliers;

use App\Filament\Resources\Suppliers\Pages\CreateSuppliers;
use App\Filament\Resources\Suppliers\Pages\EditSuppliers;
use App\Filament\Resources\Suppliers\Pages\ListSuppliers;
use App\Filament\Resources\Suppliers\Pages\ViewSuppliers;
use App\Filament\Resources\Suppliers\Schemas\SuppliersForm;
use App\Filament\Resources\Suppliers\Schemas\SuppliersInfolist;
use App\Filament\Resources\Suppliers\Tables\SuppliersTable;
use App\Models\Suppliers;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SuppliersResource extends Resource
{
    protected static ?string $model = Suppliers::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-s-truck';
        protected static string|UnitEnum|null $navigationGroup = 'Inventory';

        protected static ?string $navigationLabel = 'Supplier';

    protected static ?string $recordTitleAttribute = 'company_name';

    public static function form(Schema $schema): Schema
    {
        return SuppliersForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return SuppliersInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SuppliersTable::configure($table);
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
            'index' => ListSuppliers::route('/'),
            'create' => CreateSuppliers::route('/create'),
            'view' => ViewSuppliers::route('/{record}'),
            'edit' => EditSuppliers::route('/{record}/edit'),
        ];
    }

    public static function getRecordRouteBindingEloquentQuery(): Builder
    {
        return parent::getRecordRouteBindingEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
