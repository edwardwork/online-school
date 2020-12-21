<?php

namespace App\Helpers;

use App\User;
use App\Models\Lesson;
use App\Services\ClassroomService;

class CheckAccessToLesson
{
    public static function check(User $user, Lesson $lesson)
    {
        $status = $user->lessonStatuses()
            ->where('lesson_id', $lesson->id)
            ->firstOrCreate(
                [
                    'user_id' => $user->id,
                    'lesson_id' => $lesson->id
                ],
                [
                    'question_ids' => ClassroomService::getRandomQuestionsForLessonsByFormat($lesson),
                    'current_position' => -1,
                    'attempt' => 0,
                    'count_true_answers' => 0,
                    'current_duration' => 0,
                    'is_success' => false,
                    'max_attempt' => 3,
                    'max_duration' => 1000,
                    'threshold' => 80
                ]
            );
        if($status->has_access) {
            return true;
        }

        return $user->can('read', $lesson);
    }
}
