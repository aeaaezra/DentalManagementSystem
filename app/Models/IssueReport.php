<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class IssueReport extends Model
{
    protected $fillable = [
        'user_id',
        'issue_type',
        'description',
        'screenshot',
        'status',
        'admin_notes',
    ];

    /**
     * The user who submitted the issue report.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
