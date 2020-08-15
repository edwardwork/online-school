<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Models\Category::create(
            ['title' => 'Развлечения']
        );

        App\Models\Category::create(
            [
                'title' => 'Ставки на спорт',
                'parent_id' => 1
            ]
        );

        App\Models\Category::create(
            [
                'title' => 'Азартные игры',
                'parent_id' => 1
            ]
        );

        App\Models\Category::create(
            [
                'title' => 'Казино',
                'parent_id' => 3
            ]
        );

        App\Models\Category::create(
            [
                'title' => 'Дурак',
                'parent_id' => 3
            ]
        );
    }
}
