<?php

namespace App\Filament\Resources\TreatmentGuides;

use App\Filament\Resources\TreatmentGuides\Pages\CreateTreatmentGuide;
use App\Filament\Resources\TreatmentGuides\Pages\EditTreatmentGuide;
use App\Filament\Resources\TreatmentGuides\Pages\ListTreatmentGuides;
use App\Filament\Resources\TreatmentGuides\Schemas\TreatmentGuideForm;
use App\Filament\Resources\TreatmentGuides\Tables\TreatmentGuidesTable;
use App\Models\TreatmentGuide;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class TreatmentGuideResource extends Resource
{
    protected static ?string $model = TreatmentGuide::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBookOpen;
     protected static string|UnitEnum|null $navigationGroup = 'Appointments';
    protected static ?string $recordTitleAttribute = 'situation';

    public static function form(Schema $schema): Schema
    {
        return TreatmentGuideForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TreatmentGuidesTable::configure($table);
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
            'index' => ListTreatmentGuides::route('/'),
            'create' => CreateTreatmentGuide::route('/create'),
            'edit' => EditTreatmentGuide::route('/{record}/edit'),
        ];
    }
}
