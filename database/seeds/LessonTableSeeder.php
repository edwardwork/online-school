<?php

use Illuminate\Database\Seeder;

class LessonTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Models\Lesson::create(
            ['name' => 'Урок 1',
                'video_id' => 289366412,
                'pdf_url' => 'file.pdf',
                'topic_id' => 1]
        );
        App\Models\Lesson::create(
            ['name' => 'Урок 2',
                'video_id' => 288393864,
                'pdf_url' => 'file.pdf',
                'topic_id' => 2]
        );
        App\Models\Lesson::create(
            ['name' => 'Урок 3',
                'video_id' => 288710158,
                'pdf_url' => 'file.pdf',
                'topic_id' => 3]
        );
        App\Models\Lesson::create(
            ['name' => 'Урок 4',
                'video_id' => 288487668,
                'pdf_url' => 'file.pdf',
                'topic_id' => 4]
        );
        App\Models\Lesson::create(
            ['name' => 'Урок 5',
                'video_id' => 289235619,
                'pdf_url' => 'file.pdf',
                'topic_id' => 5]
        );
        App\Models\Lesson::create(
            ['name' => 'Урок 6',
                'video_id' => 286740784,
                'pdf_url' => 'file.pdf',
                'topic_id' => 6]
        );
    }
}
