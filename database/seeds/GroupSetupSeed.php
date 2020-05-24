<?php

use Illuminate\Database\Seeder;

class GroupSetupSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\GroupSetup::truncate();
        \App\GroupSetup::insert([
            'description' => 'Group Setup Fee',
            'currency' => 'USD',
            'amount' => 2
        ]);
    }
}
