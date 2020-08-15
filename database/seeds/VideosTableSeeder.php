<?php

use Illuminate\Database\Seeder;

class VideosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Models\IntroductionVideo::create(
            [
                'title' => 'Как незаметно мухлевать',
                'video_id' => 321291050,
                'category_id' => 5
            ]
        );
        App\Models\IntroductionVideo::create(
            [
                'title' => 'Правила игры',
                'video_id' => 320793308,
                'category_id' => 5
            ]
        );
        App\Models\IntroductionVideo::create(
            [
                'title' => 'Что такое фулл-хауз',
                'video_id' => 321169750,
                'category_id' => 4
            ]
        );
    }
}
