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
            ['category' => 'Medical'],
            ['category' => 'Memorial'],
            ['category' => 'Emergency'],
            ['category' => 'Non-profit'],
            ['category' => 'Education'],
            ['category' => 'Wedding'],
            ['category' => 'Funeral'],
            ['category' => 'Event'],
            ['category' => 'Sport'],
            ['category' => 'Travel'],
            ['category' => 'Volunteer'],
            ['category' => 'Family'],
            ['category' => 'Wishes'],
            ['category' => 'Dowry'],
            ['category' => 'Community'],
            ['category' => 'Charity'],
            ['category' => 'Donation'],
        ]);
    }
}
