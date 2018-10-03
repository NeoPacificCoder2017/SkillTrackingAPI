<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FormationDetailsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('formation_details')->insert([
            'formation_id' => 1,
            'module_id' => 1,
            'teacher_id' => 4,
            'created_at' => '2018-07-05 12:03:37',
            'updated_at' => '2018-07-05 12:03:37'
        ]);
        
        DB::table('formation_details')->insert([
            'formation_id' => 1,
            'module_id' => 2,
            'teacher_id' => 2,
            'created_at' => '2018-07-05 12:03:37',
            'updated_at' => '2018-07-05 12:03:37'
        ]);
        DB::table('formation_details')->insert([
            'formation_id' => 1,
            'module_id' => 3,
            'teacher_id' => 2,
            'created_at' => '2018-07-05 12:03:37',
            'updated_at' => '2018-07-05 12:03:37'
        ]);
        DB::table('formation_details')->insert([
            'formation_id' => 1,
            'module_id' => 4,
            'teacher_id' => 2,
            'created_at' => '2018-07-05 12:03:37',
            'updated_at' => '2018-07-05 12:03:37'
        ]);
        DB::table('formation_details')->insert([
            'formation_id' => 1,
            'module_id' => 5,
            'teacher_id' => 5,
            'created_at' => '2018-07-05 12:03:37',
            'updated_at' => '2018-07-05 12:03:37'
        ]);

        
        DB::table('formation_details')->insert([
            'formation_id' => 1,
            'module_id' => 6,
            'teacher_id' => 2,
            'created_at' => '2018-07-05 12:03:37',
            'updated_at' => '2018-07-05 12:03:37'
        ]);
        DB::table('formation_details')->insert([
            'formation_id' => 1,
            'module_id' => 7,
            'teacher_id' => 2,
            'created_at' => '2018-07-05 12:03:37',
            'updated_at' => '2018-07-05 12:03:37'
        ]);
        DB::table('formation_details')->insert([
            'formation_id' => 1,
            'module_id' => 8,
            'teacher_id' => 16,
            'created_at' => '2018-07-05 12:03:37',
            'updated_at' => '2018-07-05 12:03:37'
        ]);
        DB::table('formation_details')->insert([
            'formation_id' => 1,
            'module_id' => 9,
            'teacher_id' => 2,
            'created_at' => '2018-07-05 12:03:37',
            'updated_at' => '2018-07-05 12:03:37'
        ]);
        DB::table('formation_details')->insert([
            'formation_id' => 1,
            'module_id' => 10,
            'teacher_id' => 3,
            'created_at' => '2018-07-05 12:03:37',
            'updated_at' => '2018-07-05 12:03:37'
        ]);
    }
}
