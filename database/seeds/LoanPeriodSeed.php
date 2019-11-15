<?php

use Illuminate\Database\Seeder;

class LoanPeriodSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\LoanPeriod::truncate();
        \App\LoanPeriod::insert([
            ['period' => 'One Day', 'days' => '1'],
            ['period' => 'One Week', 'days' => '7'],
            ['period' => 'One Month', 'days' => '30'],
            ['period' => 'One Quarter', 'days' => '90'],
            ['period' => 'One Year', 'days' => '365'],
        ]);
    }
}
