<?php

namespace Database\Seeders;

use App\Models\EducationalStages\EducationalClass;
use App\Models\Subjects\EducationalClassSubject;
use App\Models\Subjects\Subject;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SubjectTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public static function run()
    {
        $subjects = [
            'اللغة العربية', 'اللغة الانجليزية', 'تربية دينية', 'رياضيات', 'حاسب الي', 'لغة فرنسية', 'لغة ألمانية'
        ];

        $educationalClasses = EducationalClass::get();

        foreach($subjects as $each_subject){

            $subject = Subject::firstOrCreate(['slug' => Str::slug($each_subject)],[
                'name' => $each_subject,
                'slug' => Str::slug($each_subject),
            ]);
            
            foreach($educationalClasses as $educationalClass){
    
                EducationalClassSubject::firstOrCreate(['subject_id' => $subject->id, 'educational_class_id' => $educationalClass->id],[
                    'subject_id' => $subject->id,
                    'educational_class_id' => $educationalClass->id
                ]);
            }
        }
    }
}
