<?php

namespace App\Filament\Resources\Econsultations;

use App\Filament\Resources\Econsultations\Pages\CreateEconsultations;
use App\Filament\Resources\Econsultations\Pages\EditEconsultations;
use App\Filament\Resources\Econsultations\Pages\ListEconsultations;
use App\Filament\Resources\Econsultations\Pages\ViewEconsultations;
use App\Filament\Resources\Econsultations\Schemas\EconsultationsForm;
use App\Filament\Resources\Econsultations\Schemas\EconsultationsInfolist;
use App\Filament\Resources\Econsultations\Tables\EconsultationsTable;
use App\Models\Econsultations;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EconsultationsResource extends Resource
{
    protected static ?string $model = Econsultations::class;

protected static string|BackedEnum|null $navigationIcon = 'heroicon-s-chat-bubble-left-right';

    protected static string|UnitEnum|null $navigationGroup = 'Econsultations';

    protected static ?string $navigationLabel = 'Econsultations';


    protected static ?string $recordTitleAttribute = 'patient_name';

    public static function form(Schema $schema): Schema
    {
        return EconsultationsForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return EconsultationsInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return EconsultationsTable::configure($table);
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
            'index' => ListEconsultations::route('/'),
            'create' => CreateEconsultations::route('/create'),
            'view' => ViewEconsultations::route('/{record}'),
            'edit' => EditEconsultations::route('/{record}/edit'),
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
