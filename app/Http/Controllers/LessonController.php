<?php

namespace App\Http\Controllers;

use App\Helpers\CheckAccessToLesson;
use App\Models\Lesson;
use App\Models\UserStatus;
use App\Models\QuestionView;

class LessonController extends Controller
{
    public function show(int $lesson_id)
    {
        $user = \Auth::user();
        $lesson = Lesson::with(['questions.answers', 'topic'])->find($lesson_id);
        $lesson_status = UserStatus::firstOrCreate(
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

        $questionCount = $lesson->question_count;
        $sortedQuestions = [];
        $questionViews = QuestionView::all();

        for($i = 0; $i < 10; $i++) {
            foreach ($questionViews as $questionView) {
                foreach ($questions->shuffle() as $question) {
                    if($questionView->id == $question->question_view_id
                        && !in_array($question, $sortedQuestions)
                        && count($sortedQuestions) != $questionCount
                    ) {
                        $sortedQuestions[] = $question;
                        break;
                    }
                }
            }
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
