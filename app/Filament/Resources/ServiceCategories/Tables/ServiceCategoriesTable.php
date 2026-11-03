<?php

namespace App\Filament\Resources\ServiceCategories\Tables;

use Filament\Actions\ActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ServiceCategoriesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('ID')
                    ->sortable(),

                TextColumn::make('category_name')
                    ->label('Category Name')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('procedures_count')
                    ->label('Procedures')
                    ->counts('procedures')
                    ->sortable(),

                TextColumn::make('legacyService.service_name')
                    ->label('Legacy Service')
                    ->placeholder('New Category')
                    ->sortable(),

                IconColumn::make('is_active')
                    ->label('Active')
                    ->boolean()
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label('Created At')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('category_name')
            ->recordActions([
                ActionGroup::make([
                    ViewAction::make(),
                    EditAction::make(),
                    DeleteAction::make()
                        ->disabled(fn ($record): bool =>
                            $record->procedures()->exists()
                            || $record->legacy_service_id !== null
                        )
                        ->tooltip('Categories with procedures or legacy service links cannot be deleted.'),
                ])
                    ->icon('heroicon-m-ellipsis-vertical')
                    ->label('')
                    ->tooltip('Category actions')
                    ->button(),
            ]);
    }
}
