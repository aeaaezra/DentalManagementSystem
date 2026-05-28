<?php

namespace App\Filament\Resources\PatientRecords;

use App\Filament\Resources\PatientRecords\Pages\CreatePatientRecords;
use App\Filament\Resources\PatientRecords\Pages\EditPatientRecords;
use App\Filament\Resources\PatientRecords\Pages\ListPatientRecords;
use App\Filament\Resources\PatientRecords\Pages\ViewPatientRecords;
use App\Filament\Resources\PatientRecords\Schemas\PatientRecordsForm;
use App\Filament\Resources\PatientRecords\Schemas\PatientRecordsInfolist;
use App\Filament\Resources\PatientRecords\Tables\PatientRecordsTable;
use App\Models\PatientRecords;
use UnitEnum;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PatientRecordsResource extends Resource
{
    protected static ?string $model = PatientRecords::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-s-identification';

    protected static string|UnitEnum|null $navigationGroup = 'Patient Records';

    protected static ?string $navigationLabel = 'Patient Records';



    protected static ?string $recordTitleAttribute = 'patient_name';

    public static function form(Schema $schema): Schema
    {
        return PatientRecordsForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return PatientRecordsInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PatientRecordsTable::configure($table);
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
            'index' => ListPatientRecords::route('/'),
            'create' => CreatePatientRecords::route('/create'),
            'view' => ViewPatientRecords::route('/{record}'),
            'edit' => EditPatientRecords::route('/{record}/edit'),
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
