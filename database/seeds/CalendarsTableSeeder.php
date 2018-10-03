<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CalendarsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('calendars')->insert([
            'formation_id' => 1,
            'file_name' => "Calendrier prévisionnel de la NPC",
            'file_url' => "npc.pdf",
        ]);
        DB::table('calendars')->insert([
            'formation_id' => 1,
            'file_name' => "Calendrier de test pour Parea",
            'file_url' => "npc2.pdf",
        ]);
    }
}
