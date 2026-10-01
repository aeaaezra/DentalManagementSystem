<?php

namespace App\Filament\Resources\IssueReports\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class IssueReportsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([


                TextColumn::make('id')
                    ->label('Report #')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('user.name')
                    ->label('Patient')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('issue_type')
                    ->label('Issue Type')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('description')
                    ->label('Description')
                    ->limit(50)
                    ->tooltip(
                        fn (TextColumn $column): ?string =>
                            $column->getState()
                    ),

                TextColumn::make('screenshot')
                    ->label('Screenshot')
                    ->formatStateUsing(
                        fn ($state) =>
                            $state ? 'Available' : 'None'
                    )
                    ->badge()
                    ->color(
                        fn ($state) =>
                            $state === 'Available'
                                ? 'success'
                                : 'gray'
                    ),

                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->colors([
                        'warning' => 'pending',
                        'info' => 'investigating',
                        'success' => 'resolved',
                        'gray' => 'closed',
                    ])
                    ->formatStateUsing(
                        fn (string $state): string =>
                            ucfirst($state)
                    )
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label('Reported')
                    ->dateTime('M d, Y h:i A')
                    ->sortable(),

                TextColumn::make('updated_at')
                    ->label('Updated')
                    ->dateTime('M d, Y h:i A')
                    ->sortable()
                    ->toggleable(
                        isToggledHiddenByDefault: true
                    ),

            ])

            ->filters([

                SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'pending' => 'Pending',
                        'investigating' => 'Investigating',
                        'resolved' => 'Resolved',
                        'closed' => 'Closed',
                    ]),

                SelectFilter::make('issue_type')
                    ->label('Issue Type')
                    ->options([
                        'Appointment Problem' => 'Appointment Problem',
                        'Login Problem' => 'Login Problem',
                        'Notification Problem' => 'Notification Problem',
                        'Payment Problem' => 'Payment Problem',
                        'Other' => 'Other',
                    ]),

            ])


            ->recordActions([

                ViewAction::make(),

                EditAction::make(),

            ])


            ->toolbarActions([

                BulkActionGroup::make([

                    DeleteBulkAction::make(),

                ]),

            ]);
    }
}
