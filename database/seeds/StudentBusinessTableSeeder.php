<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudentBusinessTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('student_businesses')->insert([
            'student_id' => 1,
            'business_id' => 6
        ]);
        DB::table('student_businesses')->insert([
            'student_id' => 2,
            'business_id' => 3
        ]);
        DB::table('student_businesses')->insert([
            'student_id' => 3,
            'business_id' => 2
        ]);
        DB::table('student_businesses')->insert([
            'student_id' => 4,
            'business_id' => 1
        ]);
        DB::table('student_businesses')->insert([
            'student_id' => 5,
            'business_id' => 2
        ]);
        DB::table('student_businesses')->insert([
            'student_id' => 6,
            'business_id' => 6
        ]);
        DB::table('student_businesses')->insert([
            'student_id' => 7,
            'business_id' => 4
        ]);
        DB::table('student_businesses')->insert([
            'student_id' => 8,
            'business_id' => 5
        ]);
        DB::table('student_businesses')->insert([
            'student_id' => 9,
            'business_id' => 7
        ]);
        DB::table('student_businesses')->insert([
            'student_id' => 10,
            'business_id' => 5
        ]);
        
    }
}
