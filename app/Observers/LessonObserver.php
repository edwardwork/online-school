<?php

namespace App\Observers;

use App\Models\Lesson;
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
