<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\EducationalStages\ClassRoom;
use App\Models\EducationalStages\EducationalClass;
use App\Models\EducationalStages\EducationalStage;
use App\Models\EducationalStages\EducationClass;

class EducationalStageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public static function run()
    {
        $educational_stages = [
            'K.G', 'المرحلة الابتدائية', 'المرحلة الاعدادية', 'المرحلة الثانوية'
        ];

        foreach($educational_stages as $educational_stage){

            EducationalStage::firstOrCreate(['name' => $educational_stage],[
                'name' => $educational_stage,
                'slug' => Str::slug($educational_stage),
            ]);
        }

        $classroom_names = ['الفصل أ', 'الفصل ب'];

        $kg_stages = ['K.G 1', 'K.G 2'];
        foreach($kg_stages as $kg_stage){
            $kgEducationalClass = EducationalClass::firstOrCreate(['educational_stage_id' => 1, 'name' => $kg_stage],[
                'name' => $kg_stage,
                'slug' => Str::slug($kg_stage)
            ]);

            foreach($classroom_names as $classroom_name){
                ClassRoom::firstOrCreate(['educational_class_id' => $kgEducationalClass->id, 'name' => $kg_stage.' - '.$classroom_name],[
                    'educational_class_id' => $kgEducationalClass->id,
                    'name' => $kg_stage.' - '.$classroom_name,
                    'slug' => Str::slug($kg_stage.' - '.$classroom_name),
                ]);
            }
        }

        $primary_stages = [
            'الصف الاول الابتدائي',
            'الصف الثاني الابتدائي',
            'الصف الثالث الابتدائي',
            'الصف الرابع الابتدائي',
            'الصف الخامس الابتدائي',
            'الصف السادس الابتدائي',
        ];
        foreach($primary_stages as $primary_stage){
            $primaryEducationalClass = EducationalClass::firstOrCreate(['educational_stage_id' => 2, 'name' => $primary_stage],[
                'name' => $primary_stage,
                'slug' => Str::slug($primary_stage),
            ]);

            foreach($classroom_names as $classroom_name){
                ClassRoom::firstOrCreate(['educational_class_id' => $primaryEducationalClass->id, 'name' => $primary_stage.' - '.$classroom_name,],[
                    'educational_class_id' => $primaryEducationalClass->id,
                    'name' => $primary_stage.' - '.$classroom_name,
                    'slug' => Str::slug($primary_stage.' - '.$classroom_name),
                ]);
            }
        }

        $preparatory_stages = [
            'الصف الاول الاعدادي',
            'الصف الثاني الاعدادي',
            'الصف الثالث الاعدادي',
        ];
        foreach($preparatory_stages as $preparatory_stage){
            $preparatoryEducationalClass = EducationalClass::firstOrCreate(['educational_stage_id' => 3, 'name' => $preparatory_stage],[
                'name' => $preparatory_stage,
                'slug' => Str::slug($preparatory_stage),
            ]);

            foreach($classroom_names as $classroom_name){
                ClassRoom::firstOrCreate(['educational_class_id' => $preparatoryEducationalClass->id, 'name' => $preparatory_stage.' - '.$classroom_name],[
                    'educational_class_id' => $preparatoryEducationalClass->id,
                    'name' => $preparatory_stage.' - '.$classroom_name,
                    'slug' => Str::slug($preparatory_stage.' - '.$classroom_name),
                ]);
            }
        }

        $secondary_stages = [
            'الصف الاول الثانوي',
            'الصف الثاني الثانوي',
            'الصف الثالث الثانوي',
        ];
        foreach($secondary_stages as $secondary_stage){
            $secondaryEducationalClass = EducationalClass::firstOrCreate(['educational_stage_id' => 4, 'name' => $secondary_stage],[
                'name' => $secondary_stage,
                'slug' => Str::slug($secondary_stage),
            ]);

            foreach($classroom_names as $classroom_name){
                ClassRoom::firstOrCreate(['educational_class_id' => $secondaryEducationalClass->id, 'name' => $secondary_stage.' - '.$classroom_name],[
                    'educational_class_id' => $secondaryEducationalClass->id,
                    'name' => $secondary_stage.' - '.$classroom_name,
                    'slug' => Str::slug($secondary_stage.' - '.$classroom_name),
                ]);
            }
        }
    }
}
