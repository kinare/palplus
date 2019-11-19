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
            ['activity' => 'Meeting', 'description' => 'Group Meeting'],
            ['activity' => 'Event', 'description' => 'Group Event'],
            ['activity' => 'Tour', 'description' => 'Group Tour'],
        ]);
    }
}
