<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Models\UserStatus;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class UserStatusController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $lessonId = $request->get("lesson_id");
        $user = Auth::user();
        // Try to get record
        $model = $user->getLessonStatus(Lesson::findOrFail($lessonId));

        return response()->json(["data" => $model]);
    }

    public function update(Request $request, UserStatus $userStatus): JsonResponse
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

    public function updateDuration(Request $request, UserStatus $userStatus): JsonResponse
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
