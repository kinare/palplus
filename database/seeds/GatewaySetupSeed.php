<?php

use Illuminate\Database\Seeder;

class GatewaySetupSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\GatewaySetup::truncate();
        \App\GatewaySetup::insert([
            ['type' => 'WITHDRAWAL', 'gateway' => 'RAVE', 'rate' =>  8.0,  'active' => 1],
            ['type' => 'DEPOSIT', 'gateway' => 'RAVE', 'rate' =>  0.0, 'active' => 1],
        ]);
    }
}
