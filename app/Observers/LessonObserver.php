<?php

namespace App\Observers;

use App\Models\Lesson;
use App\Models\UserStatus;
use App\Services\ClassroomService;
use App\User;

class LessonObserver
{
    /**
     * Handle the lesson "created" event.
     *
     * @param  \App\Models\Lesson  $lesson
     * @return void
     */
    public function created(Lesson $lesson)
    {
        $subscription = $lesson->subscription;
        if($subscription) {
            $users = User::where('subscription_id', $subscription->id)->get();

            foreach ($users as $user) {
                \Bouncer::allow($user)->to('read', $lesson);
            }
        }

        $users = User::all();
        foreach ($users as $user) {
            UserStatus::firstOrCreate(
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
        }
    }

    /**
     * Handle the lesson "updated" event.
     *
     * @param  \App\Models\Lesson  $lesson
     * @return void
     */
    public function updated(Lesson $lesson)
    {
        $subscription = $lesson->subscription;
        if($subscription) {
            $users = User::where('subscription_id', $subscription->id)->get();

            foreach ($users as $user) {
                \Bouncer::allow($user)->to('read', $lesson);
            }
        }
        $users = User::all();
        foreach ($users as $user) {
            UserStatus::firstOrCreate(
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
        }
    }

    /**
     * Handle the lesson "deleted" event.
     *
     * @param  \App\Models\Lesson  $lesson
     * @return void
     */
    public function deleted(Lesson $lesson)
    {
        $subscription = $lesson->subscription;
        if($subscription) {
            $users = User::where('subscription_id', $subscription->id)->get();

            foreach ($users as $user) {
                \Bouncer::disallow($user)->to('read', $lesson);
            }
        }
        UserStatus::where('lesson_id', $lesson->id)->delete();
    }

    /**
     * Handle the lesson "restored" event.
     *
     * @param  \App\Models\Lesson  $lesson
     * @return void
     */
    public function restored(Lesson $lesson)
    {
        //
    }

    /**
     * Handle the lesson "force deleted" event.
     *
     * @param  \App\Models\Lesson  $lesson
     * @return void
     */
    public function forceDeleted(Lesson $lesson)
    {
        //
    }
}
