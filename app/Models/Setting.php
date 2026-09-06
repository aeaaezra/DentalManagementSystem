<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'group',
        'key',
        'value',
    ];

    public static function getValue(string $group, string $key, mixed $default = null): mixed
    {
        $setting = static::where('group', $group)
            ->where('key', $key)
            ->first();

        if (!$setting) {
            return $default;
        }

        return $setting->value;
    }

    public static function setValue(string $group, string $key, mixed $value): void
    {
        static::updateOrCreate(
            [
                'group' => $group,
                'key' => $key,
            ],
            [
                'value' => $value,
            ]
        );
    }
}
