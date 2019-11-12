<?php

use Illuminate\Database\Seeder;

class ContributionPeriodsSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\ContributionPeriod::truncate();
        \App\ContributionPeriod::insert([
            ['name' => 'daily', 'length' => '1', 'period' => 'day'],
            ['name' => 'weekly', 'length' => '1', 'period' => 'week'],
            ['name' => 'monthly', 'length' => '1', 'period' => 'month'],
            ['name' => 'quartely', 'length' => '3', 'period' => 'months'],
            ['name' => 'yearly', 'length' => '12', 'period' => 'months'],
        ]);
    }
}
