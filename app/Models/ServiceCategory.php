<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ServiceCategory extends Model
{
    protected $fillable = [
        'category_name',
        'legacy_service_id',
        'description',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    public function legacyService(): BelongsTo
    {
        return $this->belongsTo(Service::class, 'legacy_service_id');
    }

    public function procedures(): HasMany
    {
        return $this->hasMany(ServiceProcedure::class, 'category_id');
    }
}

