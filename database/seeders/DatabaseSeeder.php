<?php

namespace Database\Seeders;

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
        AdminTableSeeder::run();
        EducationalStageTableSeeder::run();
        EducationClassTermsTableSeeder::run();
        InstructorTableSeeder::run();
        StudentParentTableSeeder::run();
        StudentTableSeeder::run();
        SubjectTableSeeder::run();
    }
}
