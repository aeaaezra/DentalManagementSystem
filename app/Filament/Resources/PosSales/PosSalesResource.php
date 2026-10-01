<?php

namespace App\Filament\Resources\PosSales;

use App\Filament\Resources\PosSales\Pages\CreatePosSales;
use App\Filament\Resources\PosSales\Pages\EditPosSales;
use App\Filament\Resources\PosSales\Pages\ListPosSales;
use App\Filament\Resources\PosSales\Schemas\PosSalesForm;
use App\Filament\Resources\PosSales\Tables\PosSalesTable;
use App\Models\PosSales;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class PosSalesResource extends Resource
{
    protected static ?string $model = PosSales::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-s-computer-desktop';

    protected static string|UnitEnum|null $navigationGroup = 'POS';

    protected static ?string $navigationLabel = 'POS Sales';


    protected static ?string $recordTitleAttribute = 'yes';

    public static function form(Schema $schema): Schema
    {
        return PosSalesForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PosSalesTable::configure($table);
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
            'index' => ListPosSales::route('/'),
            'create' => CreatePosSales::route('/create'),
            'edit' => EditPosSales::route('/{record}/edit'),
        ];
    }
}
