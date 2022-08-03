<?php

namespace App\Http\Controllers\Student\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\Exams\Exam;
use App\Models\Exams\ExamUser;
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

    public function show($slug)
    {
        $exam = Exam::where('slug', $slug)->first();
        $student = Student::where('id', Auth::guard('student')->user()->id)->first();

        ExamUser::where('exam_id', $exam->id)->where('student_id', $student->id)->first() == null ? abort(404) : null;

        $exam_json_file = public_path('uploads/exams/'.$exam->belongsToEducationalStage->slug.'/'.$exam->belongsToEducationalClass->slug.'/'.$exam->belongsToSubject->slug.'/'.$slug.'/exam.json');
        
        $exam_json_data = json_encode(json_decode(file_get_contents($exam_json_file), JSON_PRETTY_PRINT), true);

        return view('student.pages.exam.show')
        ->with('exam', $exam)
        ->with('exam_json_data', $exam_json_data);
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

            return '<a href="'.route('student.exam.join', $exam->slug).'" class="btn btn-success btn-sm">انضم للامتحان</a>';
        })
        ->rawColumns(['join_exam'])
        ->make(true);
    }

    public function join($slug)
    {
        $exam = Exam::where('slug', $slug)->first();
        $student = Student::where('id', Auth::guard('student')->user()->id)->first();

        ExamUser::firstOrCreate(['exam_id' => $exam->id, 'student_id' => $student->id],[
            'exam' => $exam->id,
            'student_id' => $student->id,
            'username' => $student->name,
            'email' => $student->email,
        ]);

        $this->redierctTo('student/exam/'.$slug.'/show');
    }

    public function submitAnswers(Request $request)
    {
        $answers = $request->input('answers');

        dd($answers);
    }
}
