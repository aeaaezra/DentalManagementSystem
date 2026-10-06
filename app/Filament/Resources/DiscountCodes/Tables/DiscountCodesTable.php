<?php

namespace App\Filament\Resources\DiscountCodes\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class DiscountCodesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('code')
                    ->label('Promo Code')
                    ->searchable()
                    ->sortable()
                    ->copyable()
                    ->weight('bold'),

                TextColumn::make('type')
                    ->label('Type')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'percentage' => 'Percentage',
                        'fixed' => 'Fixed',
                        default => ucfirst($state),
                    }),

                TextColumn::make('value')
                    ->label('Discount')
                    ->formatStateUsing(function ($record): string {
                        if ($record->type === 'percentage') {
                            return number_format((float) $record->value, 2) . '%';
                        }

                        return '₱' . number_format((float) $record->value, 2);
                    }),

                TextColumn::make('minimum_amount')
                    ->label('Minimum')
                    ->money('PHP')
                    ->sortable(),

                TextColumn::make('used_count')
                    ->label('Used')
                    ->formatStateUsing(function ($record): string {
                        if ($record->usage_limit === null) {
                            return $record->used_count . ' / Unlimited';
                        }

                        return $record->used_count . ' / ' . $record->usage_limit;
                    }),

                TextColumn::make('starts_at')
                    ->label('Starts')
                    ->dateTime('M d, Y h:i A')
                    ->sortable(),

                TextColumn::make('expires_at')
                    ->label('Expires')
                    ->dateTime('M d, Y h:i A')
                    ->sortable(),

                IconColumn::make('is_active')
                    ->label('Active')
                    ->boolean(),
            ])
            ->filters([
                SelectFilter::make('type')
                    ->options([
                        'percentage' => 'Percentage',
                        'fixed' => 'Fixed Amount',
                    ]),

                TernaryFilter::make('is_active')
                    ->label('Active'),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
