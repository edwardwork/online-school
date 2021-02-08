<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call('TopicTableSeeder');

        $this->command->info('Таблица тем заполнена данными!');

        $this->call('LessonTableSeeder');

        $this->command->info('Таблица уроков заполнена данными!');

        $this->call('QuestionTableSeeder');

        $this->command->info('Таблица вопросов заполнена данными!');

        $this->call('AnswerTableSeeder');

        $this->command->info('Таблица ответов заполнена данными!');

        $this->call('UserStatusesTableSeeder');

        $this->command->info('Таблица статуса_пользователей заполнена данными!');

        $this->call('CategoriesTableSeeder');

        $this->command->info('Таблица категорий заполнена данными!');

        $this->call('UserTableSeeder');

        $this->command->info('Таблица пользователей заполнена данными!');
    }
}
