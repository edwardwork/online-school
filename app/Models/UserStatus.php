<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserStatus extends Model
{
    protected $guarded = ['id'];

    protected $casts = [
        'is_success' => "bool",
        'has_access' => "bool",
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function lesson(): BelongsTo
    {
        return $this->belongsTo(Lesson::class);
    }

    public function canWatchVideo(): bool
    {
        return $this->current_duration < $this->max_duration;
    }
}
