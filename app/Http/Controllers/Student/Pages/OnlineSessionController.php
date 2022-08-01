<?php

namespace App\Http\Controllers\Student\Pages;

use App\Http\Controllers\Controller;
use App\Models\EducationalStages\ScheduleSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use App\Models\Students\Student;

class OnlineSessionController extends Controller
{
    public function __construct()
    {
        $this->middleware('student.auth:student');
    }

    public function index()
    {
        $student = Student::where('id', Auth::guard('student')->user()->id)->first();

        return view('student.pages.online-session.index')->with('student', $student);
    }

    public function show($slug)
    {
        return view('student.pages.online-session.show');
    }

    public function datatable($educational_class_id)
    {
        $scheduleSession = ScheduleSession::where('educational_class_id', $educational_class_id)->get();

        return Datatables::of($scheduleSession)
        ->editColumn('instructor', function ($scheduleSession) {
            return $scheduleSession->belongsToInstructor->name;
        })
        ->editColumn('subject', function ($scheduleSession) {
            return '<a href="'.route('admin.schedule-session.show', $scheduleSession->slug).'">'.$scheduleSession->belongsToSubject->name.'</a>';
        })
        ->editColumn('start_url', function ($scheduleSession) {
            
            if($scheduleSession->isEnded == 1){
                return '<span class="text-danger font-weight-bold">تم الامنهاء من الحصة</span>';
            }else{
                return '<a href="'.$scheduleSession->start_url.'" target="_blank">رابط بدء الحصة</a>';
            }
        })
        ->editColumn('join_url', function ($scheduleSession) {

            if($scheduleSession->isEnded == 1){
                return '<span class="text-danger font-weight-bold">تم الامنهاء من الحصة</span>';
            }else{
                return '<a href="'.$scheduleSession->join_url.'" target="_blank">رابط الانضمام الحصة</a>';
            }
        })
        ->editColumn('start_at', function ($scheduleSession) {
            return date('Y-m-d h:i a', strtotime($scheduleSession->start_at));
        })
        ->rawColumns(['subject', 'start_url', 'join_url'])
        ->make(true);
    }
}
