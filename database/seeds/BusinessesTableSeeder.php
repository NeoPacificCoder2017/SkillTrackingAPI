<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BusinessesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('businesses')->insert([
            'user_id' => 21,
            'name' => 'Isis spin sigma'
        ]);
        DB::table('businesses')->insert([
            'user_id' => 22,
            'name' => '1Click'
        ]);
        DB::table('businesses')->insert([
            'user_id' => 23,
            'name' => 'Informatique de tahiti'
        ]);
        DB::table('businesses')->insert([
            'user_id' => 24,
            'name' => 'Banque de polynésie'
        ]);
        DB::table('businesses')->insert([
            'user_id' => 25,
            'name' => 'Vini'
        ]);
        DB::table('businesses')->insert([
            'user_id' => 26,
            'name' => 'Vodafone'
        ]);
        DB::table('businesses')->insert([
            'user_id' => 27,
            'name' => 'Iaora System'
        ]);
    }
}
