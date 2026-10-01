<?php

namespace App\Filament\Resources\IssueReports\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Schemas\Schema;

class IssueReportInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([


                TextEntry::make('user.name')
                    ->label('Patient')
                    ->weight('bold'),


                TextEntry::make('issue_type')
                    ->label('Issue Type')
                    ->badge(),


                TextEntry::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'warning',
                        'investigating' => 'info',
                        'resolved' => 'success',
                        'closed' => 'gray',
                        default => 'gray',
                    }),


                TextEntry::make('description')
                    ->label('Description')
                    ->prose()
                    ->columnSpanFull(),


                ImageEntry::make('screenshot')
                    ->label('Screenshot')
                    ->disk('public')
                    ->height(300)
                    ->width(450)
                    ->extraImgAttributes([
                        'class' => 'rounded-lg object-contain',
                    ])
                    ->placeholder('No screenshot attached')
                    ->columnSpanFull(),


                TextEntry::make('admin_notes')
                    ->label('Admin Notes')
                    ->prose()
                    ->placeholder('No admin notes yet.')
                    ->columnSpanFull(),

                TextEntry::make('created_at')
                    ->label('Reported On')
                    ->dateTime('M d, Y h:i A')
                    ->placeholder('-'),


                TextEntry::make('updated_at')
                    ->label('Last Updated')
                    ->dateTime('M d, Y h:i A')
                    ->placeholder('-'),

            ]);
    }
}
