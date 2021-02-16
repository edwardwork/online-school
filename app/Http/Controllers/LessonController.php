<?php

namespace App\Http\Controllers;

use App\Helpers\CheckAccessToLesson;
use App\Models\Lesson;
use App\Models\UserStatus;
use App\Models\QuestionView;

class LessonController extends Controller
{
    public function show(Lesson $lesson)
    {
        $user = \Auth::user();
        $lesson->load(['questions.answers', 'topic']);
        $lessonStatus = $user->getLessonStatus($lesson);

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
                'status'    => $lessonStatus
            ]);
    }
}
