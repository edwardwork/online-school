<?php

use Illuminate\Database\Seeder;

class UserStatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Models\UserStatus::create(
            ['user_id' => 1,
                'lesson_id' => 1,
                'question_ids' => '2 3 4',
                'current_position' => -1,
                'count_true_answers' => 0,
                'attempt' => 0,
                'max_attempt' => 3,
                'threshold' => 80,
                'is_success' => false
            ]
        );
    }
}
