<?php

namespace App\Nova\Actions;

use App\Models\Lesson;
use App\Models\UserStatus;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;

class UpdateUserStatuses extends Action
{
    use InteractsWithQueue, Queueable;

    /**
     * Perform the action on the given models.
     *
     * @param  \Laravel\Nova\Fields\ActionFields  $fields
     * @param  \Illuminate\Support\Collection  $models
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        $lessons = Lesson::all();

        foreach ($lessons as $lesson) {
            foreach ($models as $model) {
                $status = UserStatus::firstOrCreate(
                    [
                        'lesson_id' => $lesson->id,
                        'user_id' => $model->id
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

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields()
    {
        return [];
    }
}
