<?php

namespace App\Observers;

use App\Models\Subscription;
use App\Models\UserStatus;
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
                foreach ($lessons as $lesson) {
                    $status = UserStatus::firstOrCreate(
                        [
                            'lesson_id' => $lesson->id,
                            'user_id' => $user->id
                        ],
                        [
                            'attempt' => 0,
                            'count_true_answers' => 0,
                            'current_duration' => 0,
                            'is_success' => false,
                            'has_access' => true,
                            'max_attempt' => 3,
                            'max_duration' => 1000,
                            'threshold' => 80
                        ]
                    );
                    $status->update([
                        'has_access' => true
                    ]);
                }
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
                $status = UserStatus::firstOrCreate(
                    [
                        'lesson_id' => $lesson->id,
                        'user_id' => $user->id
                    ],
                    [
                        'attempt' => 0,
                        'count_true_answers' => 0,
                        'current_duration' => 0,
                        'is_success' => false,
                        'has_access' => false,
                        'max_attempt' => 3,
                        'max_duration' => 1000,
                        'threshold' => 80
                    ]
                );
                $status->update([
                    'has_access' => false
                ]);
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
