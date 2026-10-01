<?php

namespace App\Filament\Resources\IssueReports\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class IssueReportForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([


                Select::make('user_id')
                    ->label('Patient')
                    ->relationship('user', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),

                Select::make('issue_type')
                    ->label('Issue Type')
                    ->options([
                        'Appointment Problem' => 'Appointment Problem',
                        'Login Problem' => 'Login Problem',
                        'Notification Problem' => 'Notification Problem',
                        'Payment Problem' => 'Payment Problem',
                        'Other' => 'Other',
                    ])
                    ->searchable()
                    ->required(),

                Textarea::make('description')
                    ->label('Description')
                    ->rows(6)
                    ->required()
                    ->columnSpanFull(),

                FileUpload::make('screenshot')
                    ->label('Screenshot')
                    ->image()
                    ->disk('public')
                    ->directory('issue-reports')
                    ->openable()
                    ->downloadable()
                    ->nullable(),

                Select::make('status')
                    ->label('Status')
                    ->options([
                        'pending' => 'Pending',
                        'investigating' => 'Investigating',
                        'resolved' => 'Resolved',
                        'closed' => 'Closed',
                    ])
                    ->default('pending')
                    ->required(),

                Textarea::make('admin_notes')
                    ->label('Admin Notes')
                    ->rows(5)
                    ->placeholder(
                        'Add notes about the investigation or resolution...'
                    )
                    ->nullable()
                    ->columnSpanFull(),

            ]);
    }
}
