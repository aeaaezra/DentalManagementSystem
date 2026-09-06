<?php

namespace App\Filament\Pages;

use App\Models\Setting;
use BackedEnum;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use UnitEnum;

class Settings extends Page
{
    protected static string|UnitEnum|null $navigationGroup = 'Settings';

    protected static ?string $navigationLabel = 'System Settings';

    protected static ?string $title = 'System Settings';

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static ?int $navigationSort = 1;

    protected string $view = 'filament.pages.settings';

    public string $activeModal = '';

    public array $clinic = [];

    public array $appointment = [];

    public array $notification = [];

    public array $inventory = [];

    public array $pos = [];

    public array $system = [];

    public array $security = [];

    public array $profile = [];

    public function mount(): void
    {
        $user = Auth::user();

        $this->clinic = [
            'name' => Setting::getValue(
                'clinic',
                'name',
                'Shine & Smile Dental Clinic'
            ),

            'address' => Setting::getValue(
                'clinic',
                'address',
                ''
            ),

            'phone' => Setting::getValue(
                'clinic',
                'phone',
                ''
            ),

            'email' => Setting::getValue(
                'clinic',
                'email',
                ''
            ),
        ];

        $this->appointment = [
            'opening_time' => Setting::getValue(
                'appointment',
                'opening_time',
                '08:00'
            ),

            'closing_time' => Setting::getValue(
                'appointment',
                'closing_time',
                '17:00'
            ),

            'duration' => Setting::getValue(
                'appointment',
                'duration',
                '30'
            ),

            'max_daily' => Setting::getValue(
                'appointment',
                'max_daily',
                '30'
            ),
        ];

        $this->notification = [
            'appointment_reminder' => Setting::getValue(
                'notification',
                'appointment_reminder',
                '1'
            ),

            'email_notification' => Setting::getValue(
                'notification',
                'email_notification',
                '1'
            ),

            'low_stock_alert' => Setting::getValue(
                'notification',
                'low_stock_alert',
                '1'
            ),
        ];

        $this->inventory = [
            'low_stock_limit' => Setting::getValue(
                'inventory',
                'low_stock_limit',
                '10'
            ),

            'auto_update' => Setting::getValue(
                'inventory',
                'auto_update',
                '1'
            ),
        ];

        $this->pos = [
            'tax_rate' => Setting::getValue(
                'pos',
                'tax_rate',
                '0'
            ),

            'allow_discount' => Setting::getValue(
                'pos',
                'allow_discount',
                '1'
            ),

            'receipt_footer' => Setting::getValue(
                'pos',
                'receipt_footer',
                'Thank you for visiting Shine & Smile Dental Clinic!'
            ),
        ];

        $this->system = [
            'maintenance_mode' => Setting::getValue(
                'system',
                'maintenance_mode',
                '0'
            ),

            'timezone' => Setting::getValue(
                'system',
                'timezone',
                'Asia/Manila'
            ),
        ];

        $this->profile = [
            'name' => $user?->name ?? '',
            'email' => $user?->email ?? '',
        ];

        $this->security = [
            'current_password' => '',
            'new_password' => '',
            'new_password_confirmation' => '',
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | MODAL
    |--------------------------------------------------------------------------
    */

    public function openModal(string $modal): void
    {
        $this->activeModal = $modal;
    }

    public function closeModal(): void
    {
        $this->activeModal = '';
        $this->resetValidation();
    }

    /*
    |--------------------------------------------------------------------------
    | CLINIC SETTINGS
    |--------------------------------------------------------------------------
    */

    public function saveClinic(): void
    {
        $this->validate([
            'clinic.name' => ['required', 'string', 'max:255'],
            'clinic.address' => ['nullable', 'string', 'max:500'],
            'clinic.phone' => ['nullable', 'string', 'max:50'],
            'clinic.email' => ['nullable', 'email', 'max:255'],
        ]);

        foreach ($this->clinic as $key => $value) {
            Setting::setValue('clinic', $key, $value);
        }

        $this->success('Clinic settings saved successfully.');
    }

    /*
    |--------------------------------------------------------------------------
    | APPOINTMENT SETTINGS
    |--------------------------------------------------------------------------
    */

    public function saveAppointment(): void
    {
        $this->validate([
            'appointment.opening_time' => ['required'],
            'appointment.closing_time' => ['required'],
            'appointment.duration' => ['required', 'numeric', 'min:5'],
            'appointment.max_daily' => ['required', 'numeric', 'min:1'],
        ]);

        foreach ($this->appointment as $key => $value) {
            Setting::setValue('appointment', $key, $value);
        }

        $this->success('Appointment settings saved successfully.');
    }

    /*
    |--------------------------------------------------------------------------
    | NOTIFICATIONS
    |--------------------------------------------------------------------------
    */

    public function saveNotification(): void
    {
        foreach ($this->notification as $key => $value) {
            Setting::setValue('notification', $key, $value);
        }

        $this->success('Notification settings saved successfully.');
    }

    /*
    |--------------------------------------------------------------------------
    | INVENTORY
    |--------------------------------------------------------------------------
    */

    public function saveInventory(): void
    {
        $this->validate([
            'inventory.low_stock_limit' => [
                'required',
                'numeric',
                'min:0'
            ],
        ]);

        foreach ($this->inventory as $key => $value) {
            Setting::setValue('inventory', $key, $value);
        }

        $this->success('Inventory settings saved successfully.');
    }

    /*
    |--------------------------------------------------------------------------
    | POS
    |--------------------------------------------------------------------------
    */

    public function savePos(): void
    {
        $this->validate([
            'pos.tax_rate' => [
                'required',
                'numeric',
                'min:0'
            ],
        ]);

        foreach ($this->pos as $key => $value) {
            Setting::setValue('pos', $key, $value);
        }

        $this->success('POS settings saved successfully.');
    }

    /*
    |--------------------------------------------------------------------------
    | SYSTEM
    |--------------------------------------------------------------------------
    */

    public function saveSystem(): void
    {
        foreach ($this->system as $key => $value) {
            Setting::setValue('system', $key, $value);
        }

        $this->success('System settings saved successfully.');
    }

    /*
    |--------------------------------------------------------------------------
    | PROFILE
    |--------------------------------------------------------------------------
    */

    public function saveProfile(): void
    {
        $this->validate([
            'profile.name' => [
                'required',
                'string',
                'max:255'
            ],

            'profile.email' => [
                'required',
                'email',
                'max:255'
            ],
        ]);

        $user = Auth::user();

        if (!$user) {
            return;
        }

        $user->update([
            'name' => $this->profile['name'],
            'email' => $this->profile['email'],
        ]);

        $this->success('Administrator profile updated successfully.');
    }

    /*
    |--------------------------------------------------------------------------
    | PASSWORD
    |--------------------------------------------------------------------------
    */

    public function changePassword(): void
    {
        $this->validate([
            'security.current_password' => [
                'required'
            ],

            'security.new_password' => [
                'required',
                'string',
                'min:8',
                'confirmed'
            ],
        ]);

        $user = Auth::user();

        if (
            !$user ||
            !Hash::check(
                $this->security['current_password'],
                $user->password
            )
        ) {
            $this->addError(
                'security.current_password',
                'Your current password is incorrect.'
            );

            return;
        }

        $user->update([
            'password' => Hash::make(
                $this->security['new_password']
            ),
        ]);

        $this->security = [
            'current_password' => '',
            'new_password' => '',
            'new_password_confirmation' => '',
        ];

        $this->success('Password changed successfully.');
    }

    /*
    |--------------------------------------------------------------------------
    | SUCCESS
    |--------------------------------------------------------------------------
    */

    protected function success(string $message): void
    {
        Notification::make()
            ->title($message)
            ->success()
            ->send();

        $this->closeModal();
    }
}
