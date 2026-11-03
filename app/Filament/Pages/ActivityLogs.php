<?php

namespace App\Filament\Pages;

use App\Models\AdminActivityLog;
use BackedEnum;
use UnitEnum;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Concerns\InteractsWithTable;

class ActivityLogs extends Page implements HasTable
{
    use InteractsWithTable;

    protected static string|BackedEnum|null $navigationIcon =
        Heroicon::OutlinedDocumentText;

    protected static string|UnitEnum|null $navigationGroup = 'System';

    protected static ?string $navigationLabel = 'Activity Logs';

    protected static ?string $title = 'Admin Activity Logs';

    protected string $view = 'filament.pages.activity-logs';

    public static function canAccess(): bool
    {
        return auth()->user()?->hasRole('admin') ?? false;
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(AdminActivityLog::query())
            ->columns([
                TextColumn::make('created_at')
                    ->label('Date & Time')
                    ->dateTime('M d, Y h:i A')
                    ->sortable(),

                TextColumn::make('user_name')
                    ->label('Admin')
                    ->searchable()
                    ->placeholder('System'),

                TextColumn::make('action')
                    ->badge()
                    ->searchable()
                    ->sortable(),

                TextColumn::make('module')
                    ->searchable()
                    ->sortable()
                    ->placeholder('General'),

                TextColumn::make('description')
                    ->limit(60)
                    ->wrap()
                    ->searchable()
                    ->placeholder('No description'),

                TextColumn::make('status')
                    ->badge()
                    ->sortable(),

                TextColumn::make('ip_address')
                    ->label('IP Address')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('action')
                    ->options([
                        'login' => 'Login',
                        'logout' => 'Logout',
                        'created' => 'Created',
                        'updated' => 'Updated',
                        'deleted' => 'Deleted',
                        'failed_login' => 'Failed Login',
                    ]),

                SelectFilter::make('module')
                    ->options(fn (): array => AdminActivityLog::query()
                        ->whereNotNull('module')
                        ->distinct()
                        ->orderBy('module')
                        ->pluck('module', 'module')
                        ->all()),

                SelectFilter::make('status')
                    ->options([
                        'success' => 'Success',
                        'failed' => 'Failed',
                    ]),
            ])
            ->defaultSort('created_at', 'desc')
            ->paginated([10, 25, 50]);
    }
}
