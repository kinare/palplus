<?php

use App\GroupType;
use Illuminate\Database\Seeder;

class GroupTypesSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        GroupType::truncate();
        GroupType::insert([
            ['type' => 'Mary-go-round', 'description' => 'Mary go round group'],
            ['type' => 'Tours-and-travel',  'description' => 'Tours and travel group'],
            ['type' => 'Fundraising',  'description' => 'Fund raising group'],
            ['type' => 'Investment',  'description' => 'Investment opportunities']
        ]);
    }
}
