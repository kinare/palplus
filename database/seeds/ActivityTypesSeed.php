<?php

use App\ActivityType;
use Illuminate\Database\Seeder;

class ActivityTypesSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ActivityType::truncate();
        ActivityType::insert([
            ['activity' => 'group-meeting', 'description' => 'Group Meeting'],
            ['activity' => 'group-project', 'description' => 'Group Project'],
            ['activity' => 'group-event/tour', 'description' => 'Group Event/Tour'],
        ]);
    }
}
