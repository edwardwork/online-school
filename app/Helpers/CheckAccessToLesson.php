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

        $status = $user->getLessonStatus($lesson);

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
