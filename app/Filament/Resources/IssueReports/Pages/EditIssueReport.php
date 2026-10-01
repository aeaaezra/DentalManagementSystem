<?php

namespace App\Filament\Resources\IssueReports\Pages;

use App\Filament\Resources\IssueReports\IssueReportResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditIssueReport extends EditRecord
{
    protected static string $resource = IssueReportResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
