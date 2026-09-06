<?php

namespace App\Filament\Resources\Appointments\Tables;

use App\Models\Appointments;
use App\Notifications\AppointmentApproved;
use App\Notifications\AppointmentDeclined;
use App\Notifications\CancellationConfirmed;
use App\Notifications\CancellationDeclined;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class AppointmentsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('patient.patient_name')
                    ->label('Patient Name')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('patient.tel_no')
                    ->label('Contact Number')
                    ->searchable(),

                TextColumn::make('appointment_date')
                    ->label('Date')
                    ->date()
                    ->sortable(),

                TextColumn::make('appointment_time')
                    ->label('Time')
                    ->time()
                    ->sortable(),

                TextColumn::make('reason')
                    ->limit(30)
                    ->searchable(),

                TextColumn::make('status')
                    ->badge()
                    ->colors([
                        'warning' => 'pending',
                        'success' => 'confirmed',
                        'info' => 'completed',
                        'danger' => 'cancelled',
                        'gray' => 'cancellation_requested',
                    ]),

                TextColumn::make('amount')
                    ->money('PHP')
                    ->sortable(),

                TextColumn::make('deposit')
                    ->money('PHP')
                    ->sortable(),

                TextColumn::make('balance')
                    ->money('PHP')
                    ->sortable(),
            ])

            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'confirmed' => 'Confirmed',
                        'cancellation_requested' => 'Cancellation Requested',
                        'completed' => 'Completed',
                        'cancelled' => 'Cancelled',
                    ]),
            ])

            ->recordActions([

                /*
                |--------------------------------------------------------------------------
                | View
                |--------------------------------------------------------------------------
                */

                ViewAction::make(),

                /*
                |--------------------------------------------------------------------------
                | Edit
                |--------------------------------------------------------------------------
                */

                EditAction::make(),

                /*
                |--------------------------------------------------------------------------
                | Confirm Appointment
                |--------------------------------------------------------------------------
                */

                Action::make('confirm')
                    ->label('Confirm')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->requiresConfirmation()
                    ->visible(
                        fn (Appointments $record): bool =>
                            $record->status === 'pending'
                    )
                    ->action(function (Appointments $record): void {

                        // Change appointment status
                        $record->update([
                            'status' => 'confirmed',
                        ]);

                        // Send notification to the patient
                        if (
                            $record->patient !== null &&
                            $record->patient->user !== null
                        ) {
                            $record->patient->user->notify(
                                new AppointmentApproved($record)
                            );
                        }
                    }),

                /*
                |--------------------------------------------------------------------------
                | Decline Appointment
                |--------------------------------------------------------------------------
                */

                Action::make('decline')
                    ->label('Decline')
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->visible(
                        fn (Appointments $record): bool =>
                            $record->status === 'pending'
                    )
                    ->action(function (Appointments $record): void {

                        // Change appointment status
                        $record->update([
                            'status' => 'cancelled',
                        ]);

                        // Send notification to the patient
                        if (
                            $record->patient !== null &&
                            $record->patient->user !== null
                        ) {
                            $record->patient->user->notify(
                                new AppointmentDeclined($record)
                            );
                        }
                    }),

                /*
                |--------------------------------------------------------------------------
                | Confirm Cancellation
                |--------------------------------------------------------------------------
                */

                Action::make('confirmCancellation')
                    ->label('Confirm Cancellation')
                    ->icon('heroicon-o-check-circle')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->modalHeading('Confirm Appointment Cancellation')
                    ->modalDescription(
                        'Are you sure you want to approve this cancellation request? The appointment will be permanently marked as cancelled.'
                    )
                    ->visible(
                        fn (Appointments $record): bool =>
                            $record->status === 'cancellation_requested'
                    )
                    ->action(function (Appointments $record): void {

                        // Change status to cancelled
                        $record->update([
                            'status' => 'cancelled',
                        ]);

                        // Notify the patient
                        if (
                            $record->patient !== null &&
                            $record->patient->user !== null
                        ) {
                            $record->patient->user->notify(
                                new CancellationConfirmed($record)
                            );
                        }
                    }),

                /*
                |--------------------------------------------------------------------------
                | Decline Cancellation
                |--------------------------------------------------------------------------
                */

                Action::make('declineCancellation')
                    ->label('Decline Cancellation')
                    ->icon('heroicon-o-arrow-uturn-left')
                    ->color('success')
                    ->requiresConfirmation()
                    ->modalHeading('Decline Cancellation Request')
                    ->modalDescription(
                        'Are you sure you want to decline this cancellation request? The appointment will remain confirmed.'
                    )
                    ->visible(
                        fn (Appointments $record): bool =>
                            $record->status === 'cancellation_requested'
                    )
                    ->action(function (Appointments $record): void {

                        // Return appointment to confirmed
                        $record->update([
                            'status' => 'confirmed',
                        ]);

                        // Notify the patient
                        if (
                            $record->patient !== null &&
                            $record->patient->user !== null
                        ) {
                            $record->patient->user->notify(
                                new CancellationDeclined($record)
                            );
                        }
                    }),

                /*
                |--------------------------------------------------------------------------
                | Delete
                |--------------------------------------------------------------------------
                */

                DeleteAction::make(),
            ])

            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
