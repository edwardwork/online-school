<?php

namespace App\Observers;

use App\Models\Lesson;
use App\Models\UserStatus;
use App\User;

class UserObserver
{
    /**
     * Handle the user "created" event.
     *
     * @param User $user
     * @return void
     */
    public function created(User $user)
    {
        $lessons = Lesson::all();
        foreach ($lessons as $lesson) {
            UserStatus::firstOrCreate(
                [
                    'lesson_id' => $lesson->id,
                    'user_id' => $user->id
                ],
                [
                    'attempt' => 0,
                    'count_true_answers' => 0,
                    'current_duration' => 0,
                    'is_success' => false,
                    'max_attempt' => 3,
                    'max_duration' => 1000,
                    'threshold' => 80
                ]
            );
        }
    }

    /**
     * Handle the user "updated" event.
     *
     * @param User $user
     * @return void
     */
    public function updated(User $user)
    {
        //
    }

    /**
     * Handle the user "deleted" event.
     *
     * @param User $user
     * @return void
     */
    public function deleted(User $user)
    {
        UserStatus::where('user_id', $user->id)->delete();
    }

    /**
     * Handle the user "restored" event.
     *
     * @param User $user
     * @return void
     */
    public function restored(User $user)
    {
        //
    }

    /**
     * Handle the user "force deleted" event.
     *
     * @param User $user
     * @return void
     */
    public function forceDeleted(User $user)
    {
        //
    }
}
