<?php

namespace Database\Seeders;

use App\Models\Parents\ParentStudent;
use App\Models\Students\Student;
use App\Models\Students\StudentClass;
use Illuminate\Database\Seeder;

class StudentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public static function run()
    {
        Student::factory()->count(50)->create();

        for($i = 1; $i <= 50; $i++){

            ParentStudent::create([
                'parent_id' => $i,
                'student_id' => $i,
            ]);

            StudentClass::create([
                'student_id' => $i,
                'educational_stage_id' => 2,
                'educational_class_id' => 3,
            ]);
        }
    }
}
