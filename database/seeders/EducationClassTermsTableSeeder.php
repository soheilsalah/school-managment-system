<?php

namespace Database\Seeders;

use App\Models\EducationalStages\ClassRoom;
use App\Models\EducationalStages\ClassRoomSchedule;
use App\Models\EducationalStages\EducationalClass;
use App\Models\EducationalStages\EducationalClassTerm;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\EducationalStages\Term;
use Carbon\Carbon;

class EducationClassTermsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public static function run()
    {
        $current_year = date('Y');
        $next_year = date('Y') + 1;

        $terms = [
            'الترم الاول' => [
                'start_at' => date ( 'Y-m-d' , strtotime($current_year.'-08-01')),
                'end_at' => date ( 'Y-m-d' , strtotime($next_year.'-01-31')),
            ],
            'الترم الثاني' => [
                'start_at' => date ( 'Y-m-d' , strtotime($next_year.'-03-01')),
                'end_at' => date ( 'Y-m-d' , strtotime($next_year.'-06-30')),
            ],
        ];
        
        foreach($terms as $term => $val){

            // create terms
            $term = Term::firstOrCreate(['slug' => Str::slug($term)],[
                'name' => $term,
                'start_at' => $val['start_at'],
                'end_at' => $val['end_at'],
                'slug' => Str::slug($term),
            ]);

            // create terms for educational classes
            foreach(EducationalClass::get() as $educationalClass){

                $educationalClassTerm = EducationalClassTerm::firstOrCreate([
                    'educational_class_id' => $educationalClass->id,
                    'term_id' => $term->id,
                    'start_at' => $val['start_at'],
                    'end_at' => $val['end_at'],
                ]);
            }
        }

        // get each term for each educational clss
        foreach(EducationalClassTerm::get() as $educationalClassTerm){
            
            $startTime = Carbon::createFromFormat('Y-m-d', $educationalClassTerm->start_at);
            $endTime = Carbon::createFromFormat('Y-m-d', $educationalClassTerm->end_at);
    
            $dates = [];
            
            while ($startTime->lt($endTime)) {
            
                if(in_array($startTime->dayOfWeek, [0, 1, 2, 3, 4])){
                    array_push($dates, $startTime->copy());
                }
                
                $startTime->addDay();
            }

            // create class room schecdule for each educational class
            foreach($educationalClassTerm->belongsToEducationalClass->classrooms as $classroom){

                foreach($dates as $date){

                    ClassRoomSchedule::create([
                        'educational_class_term_id' => $educationalClassTerm->id,
                        'class_room_id' => $classroom->id,
                        'schedule_date' => $date->format('Y-m-d'),
                        'slug' => md5(uniqid()),
                    ]);
                }
            }
        }
    }
}
