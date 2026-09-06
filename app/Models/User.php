<?php

namespace App\Models;

use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements FilamentUser
{
    use HasFactory;
    use Notifiable;
    use HasRoles;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'appointment_reminders',
        'promotional_emails',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'role' => 'string',
            'two_factor_enabled' => 'boolean',
            'two_factor_confirmed_at' => 'datetime',
            'appointment_reminders' => 'boolean',
            'promotional_emails' => 'boolean',
        ];
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return $this->hasRole('admin');
    }

    public function hasSystemRole(string $role): bool
    {
        return $this->hasRole($role);
    }

    public function isAdmin(): bool
    {
        return $this->hasRole('admin');
    }

    public function isPatient(): bool
    {
        return $this->hasRole('patient');
    }

    public function isReceptionist(): bool
    {
        return $this->hasRole('receptionist');
    }

    public function isDentist(): bool
    {
        return $this->hasRole('dentist');
    }

    public function patientRecord()
    {
        return $this->hasOne(
            PatientRecords::class,
            'user_id'
        );
    }

    public function dentistSetting()
    {
        return $this->hasOne(
            DentistSetting::class,
            'user_id'
        );
    }

    public function orders(): HasMany
    {
        return $this->hasMany(
            Orders::class,
            'user_id'
        );
    }
}
