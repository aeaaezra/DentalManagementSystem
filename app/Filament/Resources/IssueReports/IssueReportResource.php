<?php

namespace App\Filament\Resources\IssueReports;

use App\Filament\Resources\IssueReports\Pages\CreateIssueReport;
use App\Filament\Resources\IssueReports\Pages\EditIssueReport;
use App\Filament\Resources\IssueReports\Pages\ListIssueReports;
use App\Filament\Resources\IssueReports\Pages\ViewIssueReport;
use App\Filament\Resources\IssueReports\Schemas\IssueReportForm;
use App\Filament\Resources\IssueReports\Schemas\IssueReportInfolist;
use App\Filament\Resources\IssueReports\Tables\IssueReportsTable;
use App\Models\IssueReport;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class IssueReportResource extends Resource
{
    protected static ?string $model = IssueReport::class;

    /*
    |--------------------------------------------------------------------------
    | Navigation
    |--------------------------------------------------------------------------
    */

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBugAnt;

    protected static ?string $navigationLabel = 'Issue Reports';

    protected static ?string $modelLabel = 'Issue Report';

    protected static ?string $pluralModelLabel = 'Issue Reports';

    protected static ?string $recordTitleAttribute = 'IssueReport';


    /*
    |--------------------------------------------------------------------------
    | Form
    |--------------------------------------------------------------------------
    */

    public static function form(Schema $schema): Schema
    {
        return IssueReportForm::configure($schema);
    }


    /*
    |--------------------------------------------------------------------------
    | View / Infolist
    |--------------------------------------------------------------------------
    */

    public static function infolist(Schema $schema): Schema
    {
        return IssueReportInfolist::configure($schema);
    }


    /*
    |--------------------------------------------------------------------------
    | Table
    |--------------------------------------------------------------------------
    */

    public static function table(Table $table): Table
    {
        return IssueReportsTable::configure($table);
    }


    /*
    |--------------------------------------------------------------------------
    | Relations
    |--------------------------------------------------------------------------
    */

    public static function getRelations(): array
    {
        return [
            //
        ];
    }


    /*
    |--------------------------------------------------------------------------
    | Pages
    |--------------------------------------------------------------------------
    */

    public static function getPages(): array
    {
        return [
            'index' => ListIssueReports::route('/'),

            'create' => CreateIssueReport::route('/create'),

            'view' => ViewIssueReport::route('/{record}'),

            'edit' => EditIssueReport::route('/{record}/edit'),
        ];
    }
}
