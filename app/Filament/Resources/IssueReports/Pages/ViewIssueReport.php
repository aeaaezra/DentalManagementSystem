<?php

namespace App\Filament\Resources\IssueReports\Pages;

use App\Filament\Resources\IssueReports\IssueReportResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewIssueReport extends ViewRecord
{
    protected static string $resource = IssueReportResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
