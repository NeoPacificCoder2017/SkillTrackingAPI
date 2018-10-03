<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class FormationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('formations')->insert([
            'name' => 'Npc - Neo Pacific Coder',
            'logo' => 'npc.jpg',
            'start_at' => '2017-08-07 10:00:00',
            'end_at' => '2018-12-14 10:00:00',
            'created_at' => '2018-07-05 12:03:37',
            'updated_at' => '2018-07-05 12:03:37'
        ]);
        DB::table('formations')->insert([
            'name' => 'Tcc - Tahiti Code Camp',
            'logo' => 'tcc.jpg',
            'start_at' => '2018-04-23 10:00:00',
            'end_at' => '2018-06-28 10:00:00',
            'created_at' => '2018-07-05 12:03:37',
            'updated_at' => '2018-07-05 12:03:37'
        ]);
    }
}
