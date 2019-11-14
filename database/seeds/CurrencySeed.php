<?php

use Illuminate\Database\Seeder;

class CurrencySeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Currency::truncate();
        \App\Currency::insert([
            ['currency' => 'Kenya Shilling', 'short_description' => 'KES', 'country' => 'Kenya', 'rate' => '100'],
            ['currency' => 'Us Dollar', 'short_description' => 'USD', 'country' => 'USA', 'rate' => '1'],
        ]);
    }
}
