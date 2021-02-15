<?php

namespace App\Helpers;

use App\User;
use App\Models\Lesson;

class CheckAccessToLesson
{
    public static function check(User $user, Lesson $lesson): bool
    {
        if (!static::isSameSubscription($user, $lesson)) {
            return false;
        }

        $status = $user->lessonStatuses()
            ->firstOrCreate(
                [
                    'user_id' => $user->id,
                    'lesson_id' => $lesson->id
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

        return $status->has_access;
    }

    /**
     * @param User $user
     * @param Lesson $lesson
     * @return bool
     */
    public static function isSameSubscription(User $user, Lesson $lesson): bool
    {
        return $user->subscription_id === $lesson->subscription_id;
    }
}
