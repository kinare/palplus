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
            ['activity' => 'meeting', 'description' => 'group meeting'],
            ['activity' => 'project', 'description' => 'group project'],
            ['activity' => 'events', 'description' => 'event activity'],
            ['activity' => 'tour', 'description' => 'tour and travel'],
        ]);
    }
}
