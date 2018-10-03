<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_types')->insert([
            'name' => "Admin",
        ]);
    
        DB::table('user_types')->insert([
            'name' => "Formateur",
        ]);
    
        DB::table('user_types')->insert([
            'name' => "Etudiant",
        ]);

        DB::table('user_types')->insert([
            'name' => "Visiteur",
        ]);
    
    }
}
