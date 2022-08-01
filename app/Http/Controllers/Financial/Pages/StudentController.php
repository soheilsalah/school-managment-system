<?php

namespace App\Http\Controllers\Financial\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;
use App\Models\Parents\StudentParent;
use App\Models\Students\Student;
use App\Models\EducationalStages\EducationalClass;
use App\Models\Parents\ParentStudent;
use App\Models\Students\StudentClass;

class StudentController extends Controller
{
    public function __construct()
    {
        $this->middleware('financial.auth:financial');
    }

    public function index()
    {
        return view('financial.pages.student.index');
    }

    // datatable to view all students
    public function datatable()
    {
        $student = Student::get();

        return Datatables::of($student)
        ->editColumn('name', function ($student) {
            return '<a href="'.route('admin.student.show', $student->slug).'">'.$student->name.'</a>';
        })
        ->editColumn('email', function ($student) {
            return $student->email;
        })
        ->editColumn('educational_stage', function ($student) {
            return $student->belongsToStudentClass->belongsToEducationalStage->name;
        })
        ->editColumn('class', function ($student) {
            return $student->belongsToStudentClass->belongsToEducationalClass->name;
        })
        ->editColumn('parent', function ($student) {
            return '<a href="'.route('admin.parent.show', $student->parentStudent->belongsToParent->slug).'">'.$student->parentStudent->belongsToParent->name.'</a>';
        })
        ->editColumn('created_at', function ($student) {
            return date('Y-m-d h:i a', strtotime($student->created_at));
        })
        ->rawColumns(['name', 'parent'])
        ->make(true);
    }
}
