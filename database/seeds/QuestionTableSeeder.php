<?php

use Illuminate\Database\Seeder;

class QuestionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Models\Question::create(
            ['text' => 'Как вас зовут?',
                'lesson_id' => 1]
        );
        App\Models\Question::create(
            ['text' => 'Сколько вам лет?',
                'lesson_id' => 1]
        );
        App\Models\Question::create(
            ['text' => 'Выберите города России',
                'type' => 2,
                'lesson_id' => 1]
        );
        App\Models\Question::create(
            ['text' => 'Разместите числа в порядке возростания',
                'type' => 3,
                'lesson_id' => 1]
        );
    }
}
