<?php

namespace App\Http\Controllers\Instructor\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Instructors\InstructorClass;
use Yajra\DataTables\DataTables;

class EducationalClassController extends Controller
{
    public function __construct()
    {
        $this->middleware('instructor.auth:instructor');
    }

    public function index()
    {
        return view('instructor.pages.educational-class.index');
    }

    // datatable to view all educational classess
    public function datatable()
    {
        $instructorClass = InstructorClass::where('instructor_id', Auth::guard('instructor')->user()->id)->get();

        return Datatables::of($instructorClass)
        ->editColumn('educational_class_name', function ($instructorClass) {
            return $instructorClass->belongsToEducationalClass->name;
        })
        ->editColumn('classroom', function ($instructorClass) {
            return $instructorClass->belongsToClassRoom->name;
        })
        ->editColumn('subject', function ($instructorClass) {
            return $instructorClass->belongsToSubject->name;
        })
        ->make(true);
    }
}
