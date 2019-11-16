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
             'phone' => "016-7159613",
             'gender' => "m",
             'dob' => "1996-01-04",
             'race' => "cina",
             'marital_status' => "kahwin",
             'education_level' => "Degree",
             'occupation' => "Software Architect",
             'is_property_owner' => "0",
             'is_active' => "1",
             'is_voter' => "1",
        ]);

        DB::table('villagers')->insert([
             'house_id' => "1",
             'name' => "Sim Yu Ni",
             'ic' => "961206135034",
             'gender' => "f",
             'dob' => "1996-12-06",
             'race' => "cina",
             'marital_status' => "kahwin",
             'education_level' => "Degree",
             'occupation' => "Interior Designer",
             'is_property_owner' => "0",
             'is_active' => "1",
        ]);

        DB::table('villagers')->insert([
             'house_id' => "2",
             'name' => "Ali ak Robert",
             'ic' => "901101133713",
             'phone' => "010-5056633",
             'gender' => "m",
             'dob' => "1990-10-11",
             'race' => "bumiputera",
             'marital_status' => "bujang",
             'education_level' => "Secondary School",
             'occupation' => "Nelayan",
             'is_property_owner' => "0",
             'is_active' => "1",
        ]);

        DB::table('villagers')->insert([
             'house_id' => "2",
             'name' => "Abu ak Robert",
             'ic' => "901101133719",
             'gender' => "m",
             'dob' => "1990-10-11",
             'race' => "bumiputera",
             'marital_status' => "bujang",
             'education_level' => "Secondary School",
             'occupation' => "Nelayan",
             'is_property_owner' => "0",
             'is_active' => "1",
        ]);

        DB::table('villagers')->insert([
             'house_id' => "2",
             'name' => "Rosiah ak Joe",
             'ic' => "630705131222",
             'gender' => "f",
             'dob' => "1963-07-05",
             'race' => "bumiputera",
             'marital_status' => "kahwin",
             'education_level' => "Primary School",
             'occupation' => "Hawker",
             'is_property_owner' => "1",
             'is_active' => "1",
        ]);

        DB::table('villagers')->insert([
             'house_id' => "2",
             'name' => "Robert ak Peter",
             'ic' => "620304131753",
             'gender' => "f",
             'dob' => "1962-03-04",
             'race' => "bumiputera",
             'marital_status' => "kahwin",
             'education_level' => "Primary School",
             'occupation' => "Nelayan",
             'is_property_owner' => "1",
             'is_active' => "1",
        ]);

        DB::table('villagers')->insert([
             'house_id' => "2",
             'name' => "Vincent ak Robert",
             'ic' => "160808135877",
             'gender' => "f",
             'dob' => "2016-08-08",
             'race' => "bumiputera",
             'marital_status' => "bujang",
             'education_level' => "N/A",
             'is_property_owner' => "0",
             'is_active' => "1",
        ]);
    }
}
