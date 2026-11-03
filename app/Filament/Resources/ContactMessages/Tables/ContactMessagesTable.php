<?php

namespace App\Filament\Resources\ContactMessages\Tables;

use App\Models\Contact;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class ContactMessagesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->columns([
                TextColumn::make('name')
                    ->label('Sender')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('email')
                    ->searchable()
                    ->copyable(),

                TextColumn::make('subject')
                    ->searchable()
                    ->wrap(),

                TextColumn::make('message')
                    ->label('Message')
                    ->limit(70)
                    ->wrap(),

                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'unread' => 'danger',
                        'read' => 'info',
                        'replied' => 'success',
                        default => 'gray',
                    })
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label('Received')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'unread' => 'Unread',
                        'read' => 'Read',
                        'replied' => 'Replied',
                    ]),
            ])
            ->recordActions([
                Action::make('viewMessage')
                    ->label('View message')
                    ->icon(Heroicon::OutlinedEye)
                    ->modalHeading(fn (Contact $record): string =>
                        'Message from ' . $record->name
                    )
                    ->modalContent(fn (Contact $record) =>
                        view(
                            'filament.contact-messages.message-detail',
                            ['contact' => $record]
                        )
                    )
                    ->modalSubmitAction(false)
                    ->modalCancelActionLabel('Close')
                    ->action(fn (Contact $record) =>
                        $record->update(['status' => 'read'])
                    ),

                Action::make('markRead')
                    ->label('Mark read')
                    ->icon(Heroicon::OutlinedCheckCircle)
                    ->color('info')
                    ->visible(fn (Contact $record): bool =>
                        $record->status === 'unread'
                    )
                    ->action(fn (Contact $record) =>
                        $record->update(['status' => 'read'])
                    ),

                Action::make('markReplied')
                    ->label('Mark replied')
                    ->icon(Heroicon::OutlinedCheckBadge)
                    ->color('success')
                    ->visible(fn (Contact $record): bool =>
                        $record->status !== 'replied'
                    )
                    ->requiresConfirmation()
                    ->action(fn (Contact $record) =>
                        $record->update(['status' => 'replied'])
                    ),

                DeleteAction::make()
                    ->requiresConfirmation(),
            ]);
    }
}
