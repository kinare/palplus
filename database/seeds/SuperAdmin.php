<?php

use App\Admin;
use Illuminate\Database\Seeder;

class SuperAdmin extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::whereEmail('michaelkinare@gmail.com')->delete();
        Admin::insert([
            'name' => 'palplus',
            'email' => 'michaelkinare@gmail.com',
            'phone' => '0708338855',
            'super_admin' => true,
            'active' => true,
            'password' => \Illuminate\Support\Facades\Hash::make('admin@palplus.19'),
        ]);
    }
}
