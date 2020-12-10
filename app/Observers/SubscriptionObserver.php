<?php

namespace App\Observers;

use App\Models\Subscription;
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
                \Bouncer::allow($user)->to('read', $lesson);
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
        $lessons = $subscription->lessons;
        $users = User::where('subscription_id', $subscription->id)->get();

        foreach ($users as $user) {
            foreach ($lessons as $lesson) {
                \Bouncer::allow($user)->to('read', $lesson);
            }
        }
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
                \Bouncer::disallow($user)->to('read', $lesson);
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
