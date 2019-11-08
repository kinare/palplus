<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(SuperAdmin::class);
         $this->call(TestUser::class);
         $this->call(ActivityTypesSeed::class);
         $this->call(GroupTypesSeed::class);
         $this->call(ApproverTypeSeeder::class);
         $this->call(GenderSeed::class);
    }
}
