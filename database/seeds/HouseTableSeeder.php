<?php

use Illuminate\Database\Seeder;

class HouseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('houses')->insert([
        	 'address' => "Lot 111, Kampung Buntal",
             'household_income' => "10000",
             'family_number' => "1",
             'family_member_number' => "5"
        ]);
    }
}
