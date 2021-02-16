<?php

namespace App\Services;

use App\Models\Lesson;
use App\Models\UserStatus;
use App\User;

class ClassroomService
{
    public static function allowUserToReadLesson(User $user, Lesson $lesson)
    {
        $status = $user->getLessonStatus($lesson);

        if(!$status->has_access) {
            $status->update([
                'has_access' => true
            ]);
        }
    }

    public static function forbidUserToReadLesson(User $user, Lesson $lesson)
    {
        $status = $user->getLessonStatus($lesson);

        if($status->has_access) {
            $status->update([
                'has_access' => false
            ]);
        }
    }
}
