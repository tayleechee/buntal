<?php

use Illuminate\Database\Seeder;

class VillagerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('villagers')->insert([
        	 'house_id' => "1",
             'name' => "Elvin Heng",
             'ic' => "960104130005",
             'gender' => "m",
             'dob' => "1996-01-04",
             'race' => "Chinese",
             'marital_status' => "single",
             'education_level' => "Degree",
             'occupation' => "Student",
             'is_property_owner' => "0",
             'is_active' => "1",
        ]);
    }
}
