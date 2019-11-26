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
            ['type' => 'Merry-go-round', 'description' => 'Merry Go Round'],
            ['type' => 'Tours-and-travel',  'description' => 'Tours and Travel'],
            ['type' => 'Fundraising',  'description' => 'Fundraising'],
            ['type' => 'Saving-and-investments',  'description' => 'Savings and Investments']
        ]);
    }
}
