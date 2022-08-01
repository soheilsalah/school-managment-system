<?php

namespace App\Http\Controllers\Instructor\Pages;

use App\Http\Controllers\Controller;
use App\Models\EducationalStages\ScheduleSession;
use App\Models\Instructor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class OnlineSessionController extends Controller
{
    public function __construct()
    {
        $this->middleware('instructor.auth:instructor');
    }

    public function index()
    {
        $instructor = Instructor::where('id', Auth::guard('instructor')->user()->id)->first();

        return view('instructor.pages.online-session.index')->with('instructor', $instructor);
    }

    public function show($slug)
    {
        return view('instructor.pages.online-session.show');
    }

    public function datatable($instructor_id)
    {
        $scheduleSession = ScheduleSession::where('instructor_id', $instructor_id)->get();

        return Datatables::of($scheduleSession)
        ->editColumn('educational_stage', function ($scheduleSession) {
            return $scheduleSession->belongsToEducationalStage->name;
        })
        ->editColumn('educational_class', function ($scheduleSession) {
            return $scheduleSession->belongsToEducationalClass->name;
        })
        ->editColumn('subject', function ($scheduleSession) {
            return '<a href="'.route('instructor.schedule-session.show', $scheduleSession->slug).'">'.$scheduleSession->belongsToSubject->name.'</a>';
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
        ->editColumn('delete', function ($scheduleSession) {
            return '<button class="btn btn-danger btn-sm fa fa-trash"></button>';
        })
        ->rawColumns(['subject', 'start_url', 'join_url', 'delete'])
        ->make(true);
    }
}
