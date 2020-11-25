<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Models\UserStatus;

class LessonController extends Controller
{
    public function index()
    {
        //
    }

    public function show(int $lesson_id)
    {
        $user = \Auth::user();
        $lesson = Lesson::with(['questions.answers', 'topic'])->findOrFail($lesson_id);
        $questions = $lesson->questions;
        $answers = $lesson->questions->pluck('answers')->flatten();
        $lesson_status = UserStatus::where(['lesson_id' => $lesson->id, 'user_id' => $user->id])->first();

        return view('layouts.lessons.show')
            ->with([
                'lesson'    => $lesson,
                'questions' => $questions,
                'answers'   => $answers,
                'topic'     => $lesson->topic,
                'status'    => $lesson_status
            ]);
    }
}
