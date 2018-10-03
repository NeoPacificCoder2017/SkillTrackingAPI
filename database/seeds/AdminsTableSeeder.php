<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            'user_id' => 17,
            'function' => "Secrétaire",
        ]);
        DB::table('admins')->insert([
            'user_id' => 18,
            'function' => "Secrétaire",
        ]);
        DB::table('admins')->insert([
            'user_id' => 19,
            'function' => "Directeur",
        ]);
    }
}
