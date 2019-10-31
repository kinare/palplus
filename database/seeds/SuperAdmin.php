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
            'email' => 'michaelkinare@gmail.com',
            'phone' => '0708338855',
            'access_type' => 'editor',
            'active' => true,
            'password' => Hash::make('admin@palplus.19'),
        ]);
    }
}
