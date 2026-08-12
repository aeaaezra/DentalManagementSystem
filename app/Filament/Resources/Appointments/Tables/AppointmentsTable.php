<?php

namespace App\Filament\Resources\Appointments\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Actions\DeleteAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

use Filament\Actions\Action;
use App\Models\Appointments;
use App\Models\Notification;
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
                        'completed' => 'Completed',
                        'cancelled' => 'Cancelled',
                    ]),

            ])


            ->recordActions([

    ViewAction::make(),

    EditAction::make(),

    Action::make('confirm')
        ->label('Confirm')
        ->icon('heroicon-o-check-circle')
        ->color('success')

        ->visible(fn (Appointments $record) => $record->status === 'pending')

        ->action(function (Appointments $record) {

            $record->update([
                'status' => 'confirmed',
            ]);

            Notification::create([
                'user_id' => $record->patient->user_id,

                'title' => 'Appointment Approved',

                'message' => 'Your appointment has been approved by the clinic.',

                'is_read' => false,
            ]);

        }),


    Action::make('decline')
        ->label('Decline')
        ->icon('heroicon-o-x-circle')
        ->color('danger')

        ->visible(fn (Appointments $record) => $record->status === 'pending')

        ->action(function (Appointments $record) {

            $record->update([
                'status' => 'cancelled',
            ]);

            Notification::create([
                'user_id' => $record->patient->user_id,

                'title' => 'Appointment Declined',

                'message' => 'Unfortunately your appointment was declined.',

                'is_read' => false,
            ]);

        }),

    DeleteAction::make(),

])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
