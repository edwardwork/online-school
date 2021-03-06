<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Subscription extends Model
{
    protected $guarded = ['id'];

    public function lessons(): HasMany
    {
        return $this->hasMany(Lesson::class);
    }
}
