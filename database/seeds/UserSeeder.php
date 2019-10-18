<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
        	 'name' => "Elvin Heng",
             'email' => "hahaelvin@gmail.com",
             'password' => "$2y$12$5SsG/zbCKH1SGlpNEDyG4.4.IYHfGxfFsn/MwNgDIZATa9klLH4fW"
        ]);
    }
}
