<?php

use Illuminate\Database\Seeder;
use App\Country;

class GenderSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // \App\Gender::truncate();
        // \App\Gender::insert([
        //     ['gender' => 'male', 'created_at' => now()],
        //     ['gender' => 'female', 'created_at' => now()],
        //     ['gender' => 'other', 'created_at' => now()],
		// ]);
		

		$file = file_get_contents(base_path('database/seeds/countries.json'));
        $data = json_decode($file, true);
        foreach($data as $county_data){
            $county  = Country::create([
                'name' => $county_data["name"],
                'dial_code' => $county_data["dial_code"] ? $county_data["dial_code"]: "",
                'code' => $county_data["code"] ?  $county_data["code"]: ''
            ]);
        }
    }
}
