<?php

namespace App\Http\Controllers;

use App\Helpers\CheckAccessToLesson;
use App\Models\Lesson;
use App\Models\UserStatus;
use App\Services\ClassroomService;
use Illuminate\Support\Facades\Auth;

class LessonController extends Controller
{
    public function index()
    {
        //
    }

    public function show(int $lesson_id)
    {
        $user = \Auth::user();
        $lesson = Lesson::with(['questions.answers', 'topic'])->find($lesson_id);
        if(!CheckAccessToLesson::check($user, $lesson)) {
            throw new \Exception('По вашей подписке не возможно получить доступ к этому уроку');
        }

        $questions = $lesson->questions;
        if($questions->isEmpty()) {
            throw new \Exception('Для этого урока не заданы вопросы');
        }

        $answers = $lesson->questions->pluck('answers')->flatten();
        if($answers->isEmpty()) {
            throw new \Exception('Для этого урока не заданы ответы на вопросы');
        }

        $lesson_status = UserStatus::firstOrCreate(
            [
                'lesson_id' => $lesson->id,
                'user_id' => $user->id
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

        $questionIds = explode(" ", $lesson_status->question_ids);
        $sortedQuestions = [];
        foreach ($questionIds as $questionId) {
            $sortedQuestions[] = $questions->firstWhere('id', $questionId);
        }

        return view('layouts.lessons.show')
            ->with([
                'lesson'    => $lesson,
                'questions' => collect($sortedQuestions),
                'answers'   => $answers,
                'topic'     => $lesson->topic,
                'status'    => $lesson_status
            ]);
    }
}
