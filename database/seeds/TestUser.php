<?php

use App\User;
use Illuminate\Database\Seeder;

class TestUser extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::wherePhone('+254708338855')->delete();
        User::insert([
            'name' => 'Michael Kamau',
            'email' => 'mykmau93@gmail.com',
            'phone' => '+254708338855',
            'country_code' => '254',
            'password' => \Illuminate\Support\Facades\Hash::make('test@palplus.19'),
        ]);


    }
}
