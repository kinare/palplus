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
            ['type' => 'PROJECT', 'description'  => 'Project advert fee', 'rate'  => '2', 'currency'  => 'USD'],
            ['type' => 'INVST_OPP', 'description'  => 'Investment Opportunity advert fee', 'rate'  => '2', 'currency'  => 'USD']
        ]);
    }
}
