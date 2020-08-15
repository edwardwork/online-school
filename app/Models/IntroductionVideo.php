<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IntroductionVideo extends Model
{
    protected $guarded = ['id'];

    public function category(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}