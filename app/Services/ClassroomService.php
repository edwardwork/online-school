<?php

namespace App\Services;

use App\Models\Lesson;
use App\Models\UserStatus;
use App\User;

class ClassroomService
{
    public static function allowUserToReadLesson(User $user, Lesson $lesson)
    {
        $status = UserStatus::firstOrCreate(
            [
                'lesson_id' => $lesson->id,
                'user_id' => $user->id
            ],
            [
                'attempt' => 0,
                'count_true_answers' => 0,
                'current_duration' => 0,
                'is_success' => false,
                'has_access' => true,
                'max_attempt' => 3,
                'max_duration' => 1000,
                'threshold' => 80
            ]
        );

        if(!$status->has_access) {
            $status->update([
                'has_access' => true
            ]);
        }
    }

    public static function forbidUserToReadLesson(User $user, Lesson $lesson)
    {
        $status = UserStatus::firstOrCreate(
            [
                'lesson_id' => $lesson->id,
                'user_id' => $user->id
            ],
            [
                'attempt' => 0,
                'count_true_answers' => 0,
                'current_duration' => 0,
                'is_success' => false,
                'has_access' => false,
                'max_attempt' => 3,
                'max_duration' => 1000,
                'threshold' => 80
            ]
        );

        if($status->has_access) {
            $status->update([
                'has_access' => false
            ]);
        }
    }
}
