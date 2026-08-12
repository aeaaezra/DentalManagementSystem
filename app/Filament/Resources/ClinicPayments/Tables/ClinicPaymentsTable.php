<?php

namespace App\Filament\Resources\ClinicPayments\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Actions\DeleteAction;
use Filament\Tables\Table;

use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
class ClinicPaymentsTable
{

    public static function configure(Table $table): Table
    {
        return $table
            ->columns([

                TextColumn::make('payment_method')
                    ->label('Payment Method')
                    ->badge()
                    ->sortable()
                    ->searchable(),

                TextColumn::make('account_name')
                    ->label('Account Name')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('account_number')
                    ->label('Account Number')
                    ->copyable()
                    ->sortable()
                    ->searchable(),

                ImageColumn::make('qr_code')
                    ->label('QR Code')
                    ->disk('public')
                    ->square()
                    ->size(80),

                TextColumn::make('created_at')
                    ->label('Created')
                    ->dateTime('M d, Y h:i A')
                    ->sortable(),

            ])
            ->filters([
                //
            ])
            ->recordActions([

                ViewAction::make(),

                EditAction::make(),

                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
