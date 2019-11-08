<?php

use Illuminate\Database\Seeder;

class GenderSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Gender::truncate();
        \App\Gender::insert([
            ['gender' => 'male', 'created_at' => now()],
            ['gender' => 'female', 'created_at' => now()],
            ['gender' => 'other', 'created_at' => now()],
        ]);
    }
}
