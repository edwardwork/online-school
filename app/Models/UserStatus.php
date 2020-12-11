<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class UserStatus extends Model
{
    protected $guarded = ['id'];

    protected $casts = [
        'is_success' => "bool"
    ];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function lesson(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Lesson::class);
    }

    public function canWatchVideo(): bool
    {
        return $this->current_duration < $this->max_duration;
    }
}
