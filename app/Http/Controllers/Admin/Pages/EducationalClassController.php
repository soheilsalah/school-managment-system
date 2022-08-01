<?php

namespace App\Http\Controllers\Admin\Pages;

use App\Http\Controllers\Controller;
use App\Models\EducationalStages\ClassRoom;
use App\Models\EducationalStages\EducationalClass;
use App\Models\EducationalStages\EducationalClassSubscription;
use App\Models\EducationalStages\EducationalStage;
use App\Models\Students\Student;
use App\Models\Students\StudentClass;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;

class EducationalClassController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin.auth:admin');
    }

    public function index()
    {
        $educationalStages = EducationalStage::get();

        return view('admin.pages.educational-class.index')->with('educationalStages', $educationalStages);
    }

    public function show($slug)
    {
        $educationalClass = EducationalClass::where('slug', $slug)->first();

        return view('admin.pages.educational-class.show')->with('educationalClass', $educationalClass);
    }

    public function classrooms($slug)
    {
        $educationalClass = EducationalClass::where('slug', $slug)->first();

        return view('admin.pages.educational-class.classroom')->with('educationalClass', $educationalClass);
    }

    public function students($educational_class_id, $slug)
    {
        $classRoom = ClassRoom::where('educational_class_id', $educational_class_id)->where('slug', $slug)->first();

        $studentIDs = StudentClass::where('educational_class_id', $educational_class_id)->where('class_room_id', null)->get('student_id')->toArray();

        $students = Student::whereIn('id', $studentIDs)->get();

        return view('admin.pages.educational-class.student')
        ->with('classRoom', $classRoom)
        ->with('students', $students);
    }

    // datatable to view all educational classess
    public function datatable()
    {
        $educationalClass = EducationalClass::get();

        return Datatables::of($educationalClass)
        ->editColumn('name', function ($educationalClass) {
            return '<a href="'.route('admin.educational-class.show', $educationalClass->slug).'">'.$educationalClass->name.'</a>';
        })
        ->editColumn('belong_to_educational_stage', function ($educationalClass) {
            return $educationalClass->belongsToEducationalStage->name;
        })
        ->editColumn('classrooms', function ($educationalClass) {
            return '<a href="'.route('admin.educational-classe.classrooms', $educationalClass->slug).'">'.$educationalClass->classrooms->count().'</a>';
        })
        ->editColumn('students', function ($educationalClass) {
            return $educationalClass->belongsToEducationalStage->students->count();
        })
        
        ->editColumn('delete', function ($educationalClass) {
            return '<button class="btn btn-danger delete-educational-class" data-educational-class-id="'.$educationalClass->id.'">مسح المرحلة التعليمية</button>';
        })
        ->setRowClass(function ($educationalClass) {
            return 'tr_'.$educationalClass->id;
        })
        ->rawColumns(['name', 'classrooms', 'description', 'delete'])
        ->make(true);
    }

    // create new eductaional class
    public function create(Request $request)
    {
        $educational_class_name = $request->input('educational_class_name');
        $educational_stage_id = $request->input('educational_stage_id');
        $classrooms = $request->input('classrooms');
        $educational_stage_description = $request->input('educational_stage_description');

        EducationalClass::where('slug', Str::slug($educational_class_name))->first() != null ? $this->errorMsg('لا يمكنك تكرار اسم الفصل') : true;

        $educationalClass = EducationalClass::create([
            'name' => $educational_class_name,
            'educational_stage_id' => $educational_stage_id,
            'description' => $educational_stage_description,
            'slug' => Str::slug($educational_class_name),
        ]);

        for($i = 0; $i < count($classrooms); $i++){

            if($classrooms[$i]['classroom'] != null){

                ClassRoom::firstOrCreate(['educational_class_id' => $educationalClass->id, 'slug' => Str::slug($classrooms[$i]['classroom'])],[
                    'educational_class_id' => $educationalClass->id,
                    'name' => $classrooms[$i]['classroom'],
                    'slug' => Str::slug($classrooms[$i]['classroom']),
                ]);
            }
        }

        $getEducationalClass = EducationalClass::where('id', $educationalClass->id)->first();

        echo <<<HTML
        <script>
            var rowNode = $('#educational-classes').DataTable().row.add({
                "name": '<span contenteditable="true" class="update-educational-class-name" data-educational-class-id="{$getEducationalClass->id}">{$educational_class_name}</span>',
                "belong_to_educational_stage" : "{$getEducationalClass->belongsToEducationalStage->name}",
                "classrooms": "{$getEducationalClass->classrooms->count()}",
                "students": "0",
                "delete" : '<button class="btn btn-danger delete-educational-class" data-educational-class-id="{$getEducationalClass->id}">مسح الصف التعليمي</button>',
            }).draw().node();

            $(rowNode).addClass('tr_{$getEducationalClass->id}');
        </script>
        HTML;

        $this->successMsg('تم انشاء صف تعليمي جديد');
    }

    public function update(Request $request)
    {
        $educational_class_id = $request->input('educational_class_id');
        $educational_class_name = $request->input('educational_class_name');
        $educational_class_description = $request->input('educational_class_description');
        $one_month = $request->input('1_month');
        $three_months = $request->input('3_months');
        $six_months = $request->input('6_months');
        $one_year = $request->input('1_year');
        $slug = Str::slug($educational_class_name);

        EducationalClass::firstOrCreate(['id' => $educational_class_id],[
            'name' => $educational_class_name,
            'description' => $educational_class_description,
            'slug' => $slug,
        ]);

        EducationalClassSubscription::updateOrCreate(['educational_class_id' => $educational_class_id],[
            'one_month' => $one_month,
            'three_months' => $three_months,
            'six_months' => $six_months,
            'one_year' => $one_year,
        ]);

        $this->successMsg('تم تحديث البيانات');

        $this->redierctTo('admin/educational-class/'.$slug.'/show');
    }

    // update eductaional class name
    public function updateName(Request $request)
    {
        $educational_class_id = $request->input('educational_class_id');
        $educational_class_name = $request->input('educational_class_name');

        EducationalClass::where('id', $educational_class_id)->update([
            'name' => $educational_class_name,
            'slug' => Str::slug($educational_class_name),
        ]);
    }

    // delete eductaional class
    public function delete(Request $request)
    {
        $educational_class_id = $request->input('educational_class_id');

        EducationalClass::where('id', $educational_class_id)->delete();

        $this->successMsg('تم مسح الصف التعليمي');
    }

    // datatable to view all classrooms
    public function classroomsDatatable($slug)
    {
        $classroom = EducationalClass::where('slug', $slug)->first()->classrooms;

        return Datatables::of($classroom)
        ->editColumn('name', function ($classroom) {
            return '<span contenteditable="true" class="update-classroom-name" data-classroom-id="'.$classroom->id.'">'.$classroom->name.'</span>';
        })
        ->editColumn('students', function ($classroom) {
            return '<a href="'.route('admin.educational-class.classroom.students', [$classroom->belongsToEducationalClass->id, $classroom->slug]).'">'.$classroom->students->count().'</a>';
        })
        ->editColumn('delete', function ($classroom) {
            return '<button class="btn btn-danger delete-classroom" data-classroom-id="'.$classroom->id.'">مسح الفصل</button>';
        })
        ->setRowClass(function ($classroom) {
            return 'tr_'.$classroom->id;
        })
        ->rawColumns(['name', 'students', 'delete'])
        ->make(true);
    }

    // create new classroom
    public function createClassRoom(Request $request)
    {
        $educational_class_id = $request->input('educational_class_id');
        $classrooms = $request->input('classrooms');

        for($i = 0; $i < count($classrooms); $i++){

            $classRoom = ClassRoom::firstOrCreate(['educational_class_id' => $educational_class_id, 'slug' => Str::slug($classrooms[$i]['classroom'])],[
                'educational_class_id' => $educational_class_id,
                'name' => $classrooms[$i]['classroom'],
                'slug' => Str::slug($classrooms[$i]['classroom'])
            ]);

            echo <<<HTML
            <script>
                var rowNode = $('#classrooms').DataTable().row.add({
                    "name": '<span contenteditable="true" class="update-classroom-name" data-classroom-id="{$classRoom->id}">{$classrooms[$i]["classroom"]}</span>',
                    "students": "0",
                    "delete" : '<button class="btn btn-danger delete-classroom" data-classroom-id="{$classRoom->id}">مسح الفصل</button>',
                }).draw().node();
    
                $(rowNode).addClass('tr_{$classRoom->id}');
            </script>
            HTML;
        }

        $singular_or_plural = count($classrooms) == 1 ? 'فصل جديد' : 'فصول جديدة';

        $this->successMsg('تم انشاء '.$singular_or_plural);
    }

    // update classroom name
    public function updateClassRoomName(Request $request)
    {
        $classroom_id = $request->input('classroom_id');
        $classroom_name = $request->input('classroom_name');

        ClassRoom::where('id', $classroom_id)->update([
            'name' => $classroom_name,
            'slug' => Str::slug($classroom_name),
        ]);
    }

    // delete classroom
    public function deleteClassRoom(Request $request)
    {
        ClassRoom::where('id', $request->input('classroom_id'))->delete();

        $this->successMsg('تم  مسح هذا الفصل');
    }

    // view all students in the classroom
    public function classroomStudentsDatatable($educational_class_id, $slug)
    {
        $classRoom = ClassRoom::where('educational_class_id', $educational_class_id)->where('slug', $slug)->first();
        $studentClass = StudentClass::where('class_room_id', $classRoom->id)->get();

        return Datatables::of($studentClass)
        ->editColumn('name', function ($studentClass) {
            return $studentClass->belongsToStudent->name;
        })
        ->editColumn('remove', function ($studentClass) {
            return '<button class="btn btn-danger remove-student-from-classroom" data-classroom-id="'.$studentClass->class_room_id.'" data-student-id="'.$studentClass->student_id.'">ازاله</button>';
        })
        ->setRowClass(function ($studentClass) {
            return 'tr_'.$studentClass->student_id;
        })
        ->rawColumns(['name', 'remove'])
        ->make(true);
    }

    // append students in the classroom
    public function appendStudentsInClassroom(Request $request)
    {
        $classroom_id = $request->input('classroom_id');
        $student_ids = $request->input('student_ids');

        StudentClass::whereIn('student_id', $student_ids)->update([
            'class_room_id' => $classroom_id
        ]);
        
        $singular_or_plural = count($student_ids) == 1 ? 'طالب' : 'طلاب';

        for($i = 0; $i < count($student_ids); $i++){
            
            $student = Student::where('id', $student_ids[$i])->first();

            echo <<<HTML
            <script>
                var rowNode = $('#students').DataTable().row.add({
                    "name": '{$student->name}',
                    "remove" : '<button class="btn btn-danger remove-student-from-classroom" data-classroom-id="{$classroom_id}" data-student-id="{$student->id}">ازاله</button>',
                }).draw().node();
    
                $(rowNode).addClass('tr_{$student->id}');
            </script>
            HTML;
        }

        $this->successMsg('تمت اضافة '.$singular_or_plural);
    }

    // remove student from classrom
    public function removeStudentsInClassroom(Request $request)
    {
        $classroom_id = $request->input('classroom_id');
        $student_id = $request->input('student_id');

        StudentClass::where('student_id', $student_id)->where('class_room_id', $classroom_id)->update([
            'class_room_id' => null,
        ]);

        $this->successMsg('تمت ازاله هذا الطالب من الفصل');
    }
}
