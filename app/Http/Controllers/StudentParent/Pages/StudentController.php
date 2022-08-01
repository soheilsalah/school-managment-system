<?php

namespace App\Http\Controllers\StudentParent\Pages;

use App\Http\Controllers\Controller;
use App\Models\EducationalStages\ClassRoomSchedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;
use App\Models\Parents\StudentParent;
use App\Models\Students\Student;
use App\Models\EducationalStages\EducationalClass;
use App\Models\EducationalStages\EducationalClassTerm;
use App\Models\EducationalStages\Term;
use App\Models\Parents\ParentStudent;
use App\Models\Students\StudentClass;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    public function __construct()
    {
        $this->middleware('parent.auth:parent');
    }

    public function index()
    {
        return view('parent.pages.student.index');
    }

    public function show($slug)
    {
        $student = Student::where('slug', $slug)->first();
        $parents = StudentParent::get();
        $educationalClasses = EducationalClass::get();

        $student == null ? abort(404) : true;

        return view('parent.pages.student.show')
        ->with('student', $student)
        ->with('parents', $parents)
        ->with('educationalClasses', $educationalClasses);
    }

    // datatable to view all students
    public function datatable()
    {
        $student = StudentParent::where('id', Auth::guard('parent')->user()->id)->first()->students;

        return Datatables::of($student)
        ->editColumn('name', function ($student) {
            return $student->belongsToStudent->name;
        })
        ->editColumn('educational_stage', function ($student) {
            return $student->belongsToStudent->belongsToStudentClass->belongsToEducationalStage->name;
        })
        ->editColumn('class', function ($student) {
            return $student->belongsToStudent->belongsToStudentClass->belongsToEducationalClass->name;
        })
        ->editColumn('classroom', function ($student) {
            return $student->belongsToStudent->belongsToStudentClass->belongsToClassRoom->name;
        })
        ->editColumn('created_at', function ($student) {
            return date('Y-m-d h:i a', strtotime($student->created_at));
        })
        ->rawColumns(['name', 'parent'])
        ->make(true);
    }

    // view all student classroom sessions
    public function studentSession($slug)
    {
        $student = Student::where('slug', $slug)->first();

        foreach(Term::get() as $term){

            $start_at = Carbon::createFromFormat('Y-m-d', $term->start_at);
            $end_at = Carbon::createFromFormat('Y-m-d', $term->end_at);

            if(Carbon::now()->between($start_at, $end_at)){
                $current_term_id = $term->id;
            }
        }

        $term = Term::where('id', $current_term_id)->first();

        $classRoomSchedules = EducationalClassTerm::where('term_id', $term->id)->where('educational_class_id', $student->belongsToStudentClass->belongsToEducationalClass->id)->first()->classRoomSchedules->where('class_room_id', $student->belongsToStudentClass->belongsToClassRoom->id);

        foreach($classRoomSchedules as $classRoomSchedule){

            $dates[] = [
                'title' => 'حصص بتاريخ : '.$classRoomSchedule->schedule_date,
                'start' => $classRoomSchedule->schedule_date,
                'className' => 'bg-danger',
                'groupId' => $classRoomSchedule->id,
            ];
        }

        $datesJsonFomat = json_encode($dates);

        return view('parent.pages.student.session')
        ->with('student', $student)
        ->with('term', $term)
        ->with('datesJsonFomat', $datesJsonFomat);
    }

    public function previewClassroomSessions(Request $request)
    {
        $title = $request->input('title');
        $classroom_schedule_id = $request->input('classroom_schedule_id');

        $classRoomScheduleSessions = ClassRoomSchedule::where('id', $classroom_schedule_id)->first()->sessions;

        return view('parent.pages.student.display-classroom-sessions')
        ->with('title', $title)
        ->with('classRoomScheduleSessions', $classRoomScheduleSessions);
    }
}
