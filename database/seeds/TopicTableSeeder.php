<?php

use Illuminate\Database\Seeder;

class TopicTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Models\Topic::create(
            ['name' => 'Машины']
        );
        App\Models\Topic::create(
            ['name' => 'Животные']
        );
        App\Models\Topic::create(
            ['name' => 'Окна']
        );
        App\Models\Topic::create(
            ['name' => 'География']
        );
        App\Models\Topic::create(
            ['name' => 'Алкоголь']
        );
        App\Models\Topic::create(
            ['name' => 'Клубы']
        );
    }
}
