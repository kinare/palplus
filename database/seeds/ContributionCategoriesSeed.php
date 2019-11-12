<?php

use Illuminate\Database\Seeder;

class ContributionCategoriesSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\ContributionCategory::truncate();
        \App\ContributionCategory::insert([
            ['category' => 'membership-fee'],
            ['category' => 'medical'],
            ['category' => 'memorial'],
            ['category' => 'emergency'],
            ['category' => 'non-profit'],
            ['category' => 'education'],
            ['category' => 'wedding'],
            ['category' => 'funeral'],
            ['category' => 'event'],
            ['category' => 'sport'],
            ['category' => 'travel'],
            ['category' => 'volunteer'],
            ['category' => 'family'],
            ['category' => 'wishes'],
            ['category' => 'dowry'],
            ['category' => 'community'],
            ['category' => 'charity'],
            ['category' => 'donation'],
        ]);
    }
}
