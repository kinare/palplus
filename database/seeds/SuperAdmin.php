<?php

use App\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SuperAdmin extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::truncate();
        Admin::insert([
            'name' => 'palplus',
            'email' => 'admin@palplus.com',
            'phone' => '0708338855',
            'access_type' => 'editor',
            'active' => true,
            'password' => Hash::make('allowme@1'),
        ]);
    }
}
