<?php

use Illuminate\Database\Seeder;

class AdvertSetupSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\AdvertSetup::truncate();
        \App\AdvertSetup::insert([
            ['type' => 'EVENT', 'description'  => 'Event advert fee', 'rate'  => '2', 'currency'  => 'USD'],
            ['type' => 'INVESTMENT', 'description'  => 'Investment Opportunity advert fee', 'rate'  => '2', 'currency'  => 'USD'],
            ['type' => 'GROUP', 'description'  => 'Group setup fee', 'rate'  => '2', 'currency'  => 'USD'],
        ]);
    }
}
