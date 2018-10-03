<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModulesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('modules')->insert([
            'name' => 'Html & Css',
            'created_at' => '2018-07-05 12:03:37',
            'updated_at' => '2018-07-05 12:03:37',
            'color' => '#FFFFFF',
            'total_hours' => 20,
            'code' => 'FFenief'
        ]);

        DB::table('modules')->insert([
            'name' => 'JavaScript & Algorithmie',
            'created_at' => '2018-07-05 12:03:37',
            'updated_at' => '2018-07-05 12:03:37',
            'color' => '#FFFFFF',
            'total_hours' => 20,
            'code' => 'FFenief'
        ]);

        DB::table('modules')->insert([
            'name' => 'Base de données',
            'created_at' => '2018-07-05 12:03:37',
            'updated_at' => '2018-07-05 12:03:37',
            'color' => '#FFFFFF',
            'total_hours' => 20,
            'code' => 'FFenief'
        ]);

        DB::table('modules')->insert([
            'name' => 'PHP & MVC',
            'created_at' => '2018-07-05 12:03:37',
            'updated_at' => '2018-07-05 12:03:37',
            'color' => '#FFFFFF',
            'total_hours' => 20,
            'code' => 'FFenief'
        ]);

        DB::table('modules')->insert([
            'name' => 'Graphisme Web',
            'created_at' => '2018-07-05 12:03:37',
            'updated_at' => '2018-07-05 12:03:37',
            'color' => '#FFFFFF',
            'total_hours' => 20,
            'code' => 'FFenief'
        ]);
        
        DB::table('modules')->insert([
            'name' => 'Web Mobile',
            'created_at' => '2018-07-05 12:03:37',
            'updated_at' => '2018-07-05 12:03:37',
            'color' => '#FFFFFF',
            'total_hours' => 20,
            'code' => 'FFenief'
        ]);
        
        DB::table('modules')->insert([
            'name' => 'Réseau - Système',
            'created_at' => '2018-07-05 12:03:37',
            'updated_at' => '2018-07-05 12:03:37',
            'color' => '#FFFFFF',
            'total_hours' => 20,
            'code' => 'FFenief'
        ]);
        
        DB::table('modules')->insert([
            'name' => 'Java',
            'created_at' => '2018-07-05 12:03:37',
            'updated_at' => '2018-07-05 12:03:37',
            'color' => '#FFFFFF',
            'total_hours' => 20,
            'code' => 'FFenief'
        ]);
        
        DB::table('modules')->insert([
            'name' => 'Spécialisation Web',
            'created_at' => '2018-07-05 12:03:37',
            'updated_at' => '2018-07-05 12:03:37',
            'color' => '#FFFFFF',
            'total_hours' => 20,
            'code' => 'FFenief'
        ]);
        
        DB::table('modules')->insert([
            'name' => 'Spécialisation Logiciel Mobile',
            'created_at' => '2018-07-05 12:03:37',
            'updated_at' => '2018-07-05 12:03:37',
            'color' => '#FFFFFF',
            'total_hours' => 20,
            'code' => 'FFenief'
        ]);
        
    }
}
