<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(FormationsTableSeeder::class);
        $this->call(ModulesTableSeeder::class);
        $this->call(ProgressionsTableSeeder::class);
        $this->call(AdminsTableSeeder::class);
        $this->call(StudentBusinessTableSeeder::class);
        // $this->call(ReportCommentTableSeeder::class);
        // $this->call(ReportsTableSeeder::class);
        $this->call(SkillsTableSeeder::class);
        $this->call(UserTypesTableSeeder::class);
        $this->call(CalendarsTableSeeder::class);
        $this->call(StudentsTableSeeder::class);
        $this->call(FormationDetailsTableSeeder::class);
        $this->call(BusinessesTableSeeder::class);
    }
}
