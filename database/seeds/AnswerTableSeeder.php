<?php

use Illuminate\Database\Seeder;

class AnswerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Models\Answer::create(
            ['text' => 'Николай',
                'question_id' => 1]
        );
        App\Models\Answer::create(
            ['text' => 'Эдуард',
                'is_true' => true,
                'question_id' => 1]
        );
        App\Models\Answer::create(
            ['text' => 'Александр',
                'question_id' => 1]
        );

        App\Models\Answer::create(
            ['text' => '10',
                'question_id' => 2]
        );
        App\Models\Answer::create(
            ['text' => '11',
                'question_id' => 2]
        );
        App\Models\Answer::create(
            ['text' => '23',
                'is_true' => true,
                'question_id' => 2]
        );

        App\Models\Answer::create(
            ['text' => 'Москва',
                'is_true' => true,
                'question_id' => 3]
        );
        App\Models\Answer::create(
            ['text' => 'Екатеренбург',
                'is_true' => true,
                'question_id' => 3]
        );
        App\Models\Answer::create(
            ['text' => 'Киев',
                'question_id' => 3]
        );

        App\Models\Answer::create(
            ['text' => '1',
                'is_true' => true,
                'order_number' => 1,
                'question_id' => 4]
        );
        App\Models\Answer::create(
            ['text' => '2',
                'is_true' => true,
                'order_number' => 2,
                'question_id' => 4]
        );
        App\Models\Answer::create(
            ['text' => '3',
                'is_true' => true,
                'order_number' => 3 ,
                'question_id' => 4]
        );
    }
}
