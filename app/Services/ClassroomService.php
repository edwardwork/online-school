<?php

namespace App\Services;

use App\Models\Lesson;

class ClassroomService
{
    public static function getRandomQuestionsForLessons(Lesson $lesson, $quantity = 5)
    {
        return $lesson->questions()
            ->orderByRaw('RAND()')
            ->take($quantity)
            ->get()
            ->pluck('id')
            ->toArray();
    }

    public static function getRandomQuestionsForLessonsByFormat(Lesson $lesson, $quantity = 5)
    {
        return implode(" ", ClassroomService::getRandomQuestionsForLessons($lesson, $quantity));
    }
}
