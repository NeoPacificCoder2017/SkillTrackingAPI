<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('students')->insert([
            'formation_id' => 1,
            'user_id' => 6,
            'active' => 1,
            'created_at' => '2018-07-05 12:03:37',
            'updated_at' => '2018-07-05 12:03:37'
        ]);
        
        DB::table('students')->insert([
            'formation_id' => 1,
            'user_id' => 7,
            'active' => 1,
            'created_at' => '2018-07-05 12:03:37',
            'updated_at' => '2018-07-05 12:03:37'
        ]);
        
        DB::table('students')->insert([
            'formation_id' => 1,
            'user_id' => 8,
            'active' => 1,
            'created_at' => '2018-07-05 12:03:37',
            'updated_at' => '2018-07-05 12:03:37'
        ]);
        
        DB::table('students')->insert([
            'formation_id' => 1,
            'user_id' => 9,
            'active' => 1,
            'created_at' => '2018-07-05 12:03:37',
            'updated_at' => '2018-07-05 12:03:37'
        ]);
        
        DB::table('students')->insert([
            'formation_id' => 1,
            'user_id' => 10,
            'active' => 1,
            'created_at' => '2018-07-05 12:03:37',
            'updated_at' => '2018-07-05 12:03:37'
        ]);
        
        DB::table('students')->insert([
            'formation_id' => 1,
            'user_id' => 11,
            'active' => 1,
            'created_at' => '2018-07-05 12:03:37',
            'updated_at' => '2018-07-05 12:03:37'
        ]);
        
        DB::table('students')->insert([
            'formation_id' => 1,
            'user_id' => 12,
            'active' => 1,
            'created_at' => '2018-07-05 12:03:37',
            'updated_at' => '2018-07-05 12:03:37'
        ]);
        
        DB::table('students')->insert([
            'formation_id' => 1,
            'user_id' => 13,
            'active' => 1,
            'created_at' => '2018-07-05 12:03:37',
            'updated_at' => '2018-07-05 12:03:37'
        ]);
        
        DB::table('students')->insert([
            'formation_id' => 1,
            'user_id' => 14,
            'active' => 1,
            'created_at' => '2018-07-05 12:03:37',
            'updated_at' => '2018-07-05 12:03:37'
        ]);
        
        DB::table('students')->insert([
            'formation_id' => 1,
            'user_id' => 15,
            'active' => 1,
            'created_at' => '2018-07-05 12:03:37',
            'updated_at' => '2018-07-05 12:03:37'
        ]);
    }
}
