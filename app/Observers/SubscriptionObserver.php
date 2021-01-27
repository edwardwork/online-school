<?php

namespace App\Observers;

use App\Models\Subscription;
use App\Models\UserStatus;
use App\Services\ClassroomService;
use App\User;
use Silber\Bouncer\Bouncer;

class SubscriptionObserver
{
    /**
     * Handle the subscription "created" event.
     *
     * @param  \App\Models\Subscription  $subscription
     * @return void
     */
    public function created(Subscription $subscription)
    {
        $lessons = $subscription->lessons;
        $users = User::where('subscription_id', $subscription->id)->get();

        foreach ($users as $user) {
            foreach ($lessons as $lesson) {
                ClassroomService::allowUserToReadLesson($user, $lesson);
            }
        }
    }

    /**
     * Handle the subscription "updated" event.
     *
     * @param  \App\Models\Subscription  $subscription
     * @return void
     */
    public function updated(Subscription $subscription)
    {

    }

    /**
     * Handle the subscription "deleted" event.
     *
     * @param  \App\Models\Subscription  $subscription
     * @return void
     */
    public function deleted(Subscription $subscription)
    {
        $lessons = $subscription->lessons;
        $users = User::where('subscription_id', $subscription->id)->get();

        foreach ($users as $user) {
            foreach ($lessons as $lesson) {
                ClassroomService::forbidUserToReadLesson($user, $lesson);
            }
        }
    }

    /**
     * Handle the subscription "restored" event.
     *
     * @param  \App\Models\Subscription  $subscription
     * @return void
     */
    public function restored(Subscription $subscription)
    {
        //
    }

    /**
     * Handle the subscription "force deleted" event.
     *
     * @param  \App\Models\Subscription  $subscription
     * @return void
     */
    public function forceDeleted(Subscription $subscription)
    {
        //
    }
}
