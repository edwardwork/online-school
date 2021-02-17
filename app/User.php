<?php

namespace App;

use App\Models\Lesson;
use App\Models\Manual;
use App\Models\Subscription;
use App\Models\UserStatus;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Silber\Bouncer\Database\HasRolesAndAbilities;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class User extends Authenticatable
{
    use Notifiable, HasRolesAndAbilities;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function subscription(): BelongsTo
    {
        return $this->belongsTo(Subscription::class);
    }

    public function lessonStatuses(): HasMany
    {
        return $this->hasMany(UserStatus::class);
    }

    public function getLessonStatus(Lesson $lesson): \Illuminate\Database\Eloquent\Model
    {
        return $this->lessonStatuses()->firstOrCreate(
            [
                'user_id'      => $this->id,
                'lesson_id'    => $lesson->id
            ],
            [
                'attempt'               => 0,
                'count_true_answers'    => 0,
                'current_duration'      => 0,
                'is_success'            => false,
                'max_attempt'           => 3,
                'max_duration'          => 1000,
                'threshold'             => 80
            ]
        );
    }

    public function manuals(): HasMany
    {
        return $this->hasMany(Manual::class);
    }
}
