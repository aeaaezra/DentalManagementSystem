<?php

namespace App\Filament\Resources\Bills\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Tables\Filters\SelectFilter;
use Filament\Actions\Action;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Notifications\Notification;
use App\Services\BillingService;

class BillsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('invoice_number')
                        ->label('Invoice #')
                        ->searchable()
                        ->sortable()
                        ->copyable()
                        ->weight('bold'),

                TextColumn::make('patient.patient_name')
                        ->label('Patient')
                        ->searchable()
                        ->sortable()
                        ->placeholder('No Patient')
                        ->weight('bold'),

                TextColumn::make('module')
                        ->badge()
                        ->formatStateUsing(fn (string $state) => match ($state) {
                            'appointment' => 'Appointment',
                            'pos' => 'POS',
                            'ordering' => 'Ordering',
                            'econsultation' => 'E-Consultation',
                            default => ucfirst($state),
                        })

                        ->color(fn (string $state) => match ($state) {
                            'appointment' => 'primary',
                            'pos' => 'success',
                            'ordering' => 'warning',
                            'econsultation' => 'danger',
                            default => 'gray',
                        }),

                TextColumn::make('subtotal')
                    ->money('PHP')
                    ->sortable(),
                TextColumn::make('discount')
                    ->money('PHP')
                    ->sortable(),
                TextColumn::make('tax')
                    ->money('PHP')
                    ->sortable(),
                TextColumn::make('total')
                    ->money('PHP', divideBy: 1)
                    ->sortable(),
                TextColumn::make('amount_paid')
                    ->money('PHP')
                    ->sortable(),
                TextColumn::make('balance')
                    ->money('PHP')
                    ->sortable(),

                TextColumn::make('payment_status')
                    ->badge()
                    ->icon(fn (string $state) => match ($state) {
                        'Pending' => 'heroicon-m-clock',
                        'Partial' => 'heroicon-m-banknotes',
                        'Paid' => 'heroicon-m-check-circle',
                        default => 'heroicon-m-question-mark-circle',
                    })
                    ->color(fn (string $state) => match ($state) {
                        'Pending' => 'warning',
                        'Partial' => 'info',
                        'Paid' => 'success',
                        default => 'gray',
                    }),

                TextColumn::make('payment_method')
                        ->label('Payment')
                        ->placeholder('Not Paid')
                        ->badge()
                        ->color(fn (?string $state) => match ($state) {
                            'Cash' => 'success',
                            'GCash' => 'primary',
                            'Maya' => 'warning',
                            'Card' => 'info',
                            null => 'gray',
                            default => 'gray',
                        }),

                TextColumn::make('created_at')
                    ->since()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->since()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                    SelectFilter::make('module')
                        ->options([
                            'appointment' => 'Appointment',
                            'pos' => 'POS',
                            'ordering' => 'Ordering',
                            'econsultation' => 'E-Consultation',
                        ]),

                    SelectFilter::make('payment_status')
                        ->options([
                            'Pending' => 'Pending',
                            'Partial' => 'Partial',
                            'Paid' => 'Paid',
                        ]),
                ])
            ->recordActions([
                ViewAction::make(),

            Action::make('receivePayment')
                    ->label('Receive Payment')
                    ->icon('heroicon-o-banknotes')
                    ->color('success')
                    ->requiresConfirmation()
                    ->hidden(fn ($record) => $record->payment_status === 'Paid')

                    ->form([

        TextInput::make('amount')
            ->numeric()
            ->required()
            ->default(fn ($record) => $record->balance)
            ->maxValue(fn ($record) => $record->balance)
            ->helperText(fn ($record) => 'Remaining Balance: ₱' . number_format($record->balance, 2)),

        Select::make('payment_method')
            ->options([
                'Cash' => 'Cash',
                'GCash' => 'GCash',
                'Maya' => 'Maya',
                'Card' => 'Card',
            ])
            ->required(),

        TextInput::make('reference_number')
            ->label('Reference Number'),

        Textarea::make('remarks')
            ->rows(3),

    ])

                     ->action(function ($record, array $data) {

                        try {

                            app(BillingService::class)->recordPayment(
                                $record,
                                $data['amount'],
                                $data['payment_method'],
                                $data['reference_number'] ?? null,
                                $data['remarks'] ?? null,
                            );

                            Notification::make()
                                ->title('Payment Recorded Successfully')
                                ->success()
                                ->send();

                        } catch (\Exception $e) {

                            Notification::make()
                                ->title($e->getMessage())
                                ->danger()
                                ->send();

                        }

                    }),
            ])

            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
