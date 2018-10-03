<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProgressionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (range(1, 97) as $skillsArray) {
            DB::table('progressions')->insert([
                'student_id' => 1,
                'skill_id' => $skillsArray,
                'student_validation' => 0,
                'teacher_validation' => 0,
                'created_at' => '2018-07-05 12:03:37',
                'updated_at' => '2018-07-05 12:03:37'
            ]);
        };
        foreach (range(1, 97) as $skillsArray) {
            DB::table('progressions')->insert([
                'student_id' => 2,
                'skill_id' => $skillsArray,
                'student_validation' => 0,
                'teacher_validation' => 0,
                'created_at' => '2018-07-05 12:03:37',
                'updated_at' => '2018-07-05 12:03:37'
            ]);
        };
        foreach (range(1, 97) as $skillsArray) {
            DB::table('progressions')->insert([
                'student_id' => 3,
                'skill_id' => $skillsArray,
                'student_validation' => 0,
                'teacher_validation' => 0,
                'created_at' => '2018-07-05 12:03:37',
                'updated_at' => '2018-07-05 12:03:37'
            ]);
        };
        foreach (range(1, 97) as $skillsArray) {
            DB::table('progressions')->insert([
                'student_id' => 4,
                'skill_id' => $skillsArray,
                'student_validation' => 0,
                'teacher_validation' => 0,
                'created_at' => '2018-07-05 12:03:37',
                'updated_at' => '2018-07-05 12:03:37'
            ]);
        };
        foreach (range(1, 97) as $skillsArray) {
            DB::table('progressions')->insert([
                'student_id' => 5,
                'skill_id' => $skillsArray,
                'student_validation' => 0,
                'teacher_validation' => 0,
                'created_at' => '2018-07-05 12:03:37',
                'updated_at' => '2018-07-05 12:03:37'
            ]);
        };
        foreach (range(1, 97) as $skillsArray) {
            DB::table('progressions')->insert([
                'student_id' => 6,
                'skill_id' => $skillsArray,
                'student_validation' => 0,
                'teacher_validation' => 0,
                'created_at' => '2018-07-05 12:03:37',
                'updated_at' => '2018-07-05 12:03:37'
            ]);
        };
        foreach (range(1, 97) as $skillsArray) {
            DB::table('progressions')->insert([
                'student_id' => 7,
                'skill_id' => $skillsArray,
                'student_validation' => 0,
                'teacher_validation' => 0,
                'created_at' => '2018-07-05 12:03:37',
                'updated_at' => '2018-07-05 12:03:37'
            ]);
        };
        foreach (range(1, 97) as $skillsArray) {
            DB::table('progressions')->insert([
                'student_id' => 8,
                'skill_id' => $skillsArray,
                'student_validation' => 0,
                'teacher_validation' => 0,
                'created_at' => '2018-07-05 12:03:37',
                'updated_at' => '2018-07-05 12:03:37'
            ]);
        };
        foreach (range(1, 97) as $skillsArray) {
            DB::table('progressions')->insert([
                'student_id' => 9,
                'skill_id' => $skillsArray,
                'student_validation' => 0,
                'teacher_validation' => 0,
                'created_at' => '2018-07-05 12:03:37',
                'updated_at' => '2018-07-05 12:03:37'
            ]);
        };
        foreach (range(1, 97) as $skillsArray) {
            DB::table('progressions')->insert([
                'student_id' => 10,
                'skill_id' => $skillsArray,
                'student_validation' => 0,
                'teacher_validation' => 0,
                'created_at' => '2018-07-05 12:03:37',
                'updated_at' => '2018-07-05 12:03:37'
            ]);
        };

    }
}
