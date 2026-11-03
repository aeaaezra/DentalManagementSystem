<?php

namespace App\Filament\Resources\ServiceCategories\RelationManagers;

use Filament\Actions\ActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ProceduresRelationManager extends RelationManager
{
    protected static string $relationship = 'procedures';

    protected static ?string $title = 'Service Procedures';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('procedure_name')
                    ->label('Procedure Name')
                    ->required()
                    ->maxLength(255),

                TextInput::make('price')
                    ->label('Price (PHP)')
                    ->numeric()
                    ->prefix('₱')
                    ->required()
                    ->minValue(0),

                TextInput::make('pricing_unit')
                    ->label('Pricing Unit')
                    ->placeholder('Per tooth, per session, per quadrant'),

                TextInput::make('duration_minutes')
                    ->label('Duration (Minutes)')
                    ->numeric()
                    ->integer()
                    ->required()
                    ->minValue(1)
                    ->step(1),

                Textarea::make('description')
                    ->label('Description')
                    ->rows(3)
                    ->columnSpanFull(),

                Toggle::make('is_active')
                    ->label('Active')
                    ->default(true),
            ])
            ->columns(2);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('procedure_name')
                    ->label('Procedure')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('price')
                    ->label('Price')
                    ->money('PHP')
                    ->sortable(),

                TextColumn::make('pricing_unit')
                    ->label('Pricing Unit')
                    ->placeholder('Not specified'),

                TextColumn::make('duration_minutes')
                    ->label('Duration')
                    ->suffix(' min')
                    ->placeholder('Not specified'),

                IconColumn::make('is_active')
                    ->label('Active')
                    ->boolean(),
            ])
            ->headerActions([
                CreateAction::make()
                    ->label('Add Procedure'),
            ])
            ->recordActions([
                ActionGroup::make([
                    ViewAction::make(),
                    EditAction::make(),
                    DeleteAction::make(),
                ])
                    ->icon('heroicon-m-ellipsis-vertical')
                    ->label('')
                    ->tooltip('Procedure actions')
                    ->button(),
            ]);
    }
}
