<?php

namespace App\Providers;

use App\Models\Lesson;
use App\Models\Subscription;
use App\Observers\LessonObserver;
use App\Observers\SubscriptionObserver;
use App\Observers\UserObserver;
use App\User;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Subscription::observe(SubscriptionObserver::class);
        Lesson::observe(LessonObserver::class);
        User::observe(UserObserver::class);
    }
}
