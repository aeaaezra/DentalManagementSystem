<?php

namespace App\Filament\Resources\IssueReports\Pages;

use App\Filament\Resources\IssueReports\IssueReportResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListIssueReports extends ListRecords
{
    protected static string $resource = IssueReportResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
