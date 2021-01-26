<?php

namespace App\Http\Controllers;

use App\Models\UserStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserStatusController extends Controller
{
    public function store(Request $request)
    {
        $lessonId = $request->get("lesson_id");
        // Try to get record
        $model = UserStatus::firstOrCreate(
            [
                'user_id' => Auth::id(),
                'lesson_id' => $lessonId
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

        return response()->json(["data" => $model]);
    }

    public function update(Request $request, UserStatus $userStatus)
    {
        $lessonId = $request->get("lesson_id");

        // Try to get record
        $model = UserStatus::where('user_id', '=', Auth::id())
            ->where('lesson_id', '=', $lessonId)
            ->first();

        if (!$model) {
            return response()->json(["data" => "Error, Object not found!"]);
        }
        $model->count_true_answers = $request->get("count_true_answers");
        if($request->get('needIncreaseAttempt', true)) {
            $model->attempt += 1;
        }

        if( ($model->count_true_answers / $model->lesson->question_count * 100) >= $model->threshold) {
            $model->is_success = true;
        }

        $model->save();

        return response()->json(["data" => $model]);
    }

    public function updateDuration(Request $request, UserStatus $userStatus)
    {
        $lessonId = $request->get("lesson_id");

        // Try to get record
        $model = UserStatus::where('user_id', '=', Auth::id())
            ->where('lesson_id', '=', $lessonId)
            ->first();

        if (!$model) {
            return response()->json(["data" => "Error, Object not found!"]);
        }

        $model->current_duration += $request->get('duration');

        if($request->has('max_duration')) {
            $model->max_duration = $request->get('max_duration') * 3;
        }

        $model->save();

        return response()->json(["data" => $model]);
    }
}
