<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Country;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //India Country
        $indiaCountry = Country::where('name', '=', 'India')->firstOrFail();
        DB::table('states')->insert([
            'name' => 'Gujarat',
            'country_id'=>$indiaCountry->id
        ]);
        DB::table('states')->insert([
            'name' => 'Maharastra',
            'country_id'=>$indiaCountry->id
        ]);
        
        //Austrlia Country
        $austrliaCountry = Country::where('name', '=', 'Australia')->firstOrFail();
        DB::table('states')->insert([
            'name' => 'Queensland',
            'country_id'=>$austrliaCountry->id
        ]);
        DB::table('states')->insert([
            'name' => 'Victoria',
            'country_id'=>$austrliaCountry->id
        ]);
    }
}
