<?php

namespace App\Filament\Resources\Users\Pages;

use App\Filament\Resources\Users\UsersResource;
use Filament\Resources\Pages\CreateRecord;

class CreateUsers extends CreateRecord
{
    protected static string $resource = UsersResource::class;

    protected array $rolesToSync = [];

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $this->rolesToSync = $data['roles'] ?? [];

        unset($data['roles']);

        return $data;
    }

    protected function afterCreate(): void
    {
        $roles = array_values(array_unique(array_merge(
            $this->rolesToSync,
            [$this->record->role],
        )));

        $this->record->syncRoles($roles);
    }
}
