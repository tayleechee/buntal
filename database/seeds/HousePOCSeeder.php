<?php

use Illuminate\Database\Seeder;

class HousePOCSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('house_p_o_c')->insert([
        	 'house_id' => "1",
             'villager_id' => "1",
        ]);

        DB::table('house_p_o_c')->insert([
        	 'house_id' => "2",
             'villager_id' => "3",
        ]);
    }
}
