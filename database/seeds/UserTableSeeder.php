<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\User::create([
            'name' => 'Edward',
            'email' => 'askanii@ukr.net',
            'password' => bcrypt('123456'),
        ]);
    }
}
