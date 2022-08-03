<?php

namespace App\Http\Controllers\Student\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\Exams\Exam;
use App\Models\Students\Student;
use Illuminate\Support\Facades\Auth;

class ExamController extends Controller
{
    public function __construct()
    {
        $this->middleware('student.auth:student');
    }

    public function index()
    {
        $student = Student::where('id', Auth::guard('student')->user()->id)->first();

        return view('student.pages.exam.index')->with('student', $student);
    }

    public function datatable($educational_class_id)
    {
        $exam = Exam::where('educational_class_id', $educational_class_id)->where('isPublished', 1)->get();

        return Datatables::of($exam)
        ->editColumn('exam', function ($exam) {
            return $exam->title;
        })
        ->editColumn('subject', function ($exam) {
            return $exam->belongsToSubject->name;
        })
        ->editColumn('join_exam', function ($exam) {

            return '<a href="#" class="btn btn-success btn-sm">انضم للامتحان</a>';
        })
        ->rawColumns(['join_exam'])
        ->make(true);
    }
}
