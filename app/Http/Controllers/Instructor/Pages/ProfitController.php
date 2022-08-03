<?php

namespace App\Http\Controllers\Instructor\Pages;

use App\Http\Controllers\Controller;
use App\Models\EducationalStages\ScheduleSession;
use App\Models\Instructor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class ProfitController extends Controller
{
    public function __construct()
    {
        $this->middleware('instructor.auth:instructor');
    }

    public function sessions()
    {
        $instructor = Instructor::where('id', Auth::guard('instructor')->user()->id)->first();

        $total_profit = ScheduleSession::where('instructor_id', $instructor->id)->where('isEnded', 1)->where('ended_by', 'instructor')->sum('price');

        return view('instructor.pages.profit.my-sessions')->with('instructor', $instructor);
    }

    public function books()
    {
        return view('instructor.pages.profit.my-books');
    }

    public function myBooksProfitDatatable()
    {
        # code...
    }

    public function mySessionsProfitDatatable($instructor_id)
    {
        $scheduleSession = ScheduleSession::where('instructor_id', $instructor_id)->where('isEnded', 1)->get();

        return Datatables::of($scheduleSession)
        ->editColumn('topic', function ($scheduleSession) {
            return $scheduleSession->topic;
        })
        ->editColumn('subject', function ($scheduleSession) {
            return $scheduleSession->belongsToSubject->name;
        })
        ->editColumn('educational_class', function ($scheduleSession) {
            return $scheduleSession->belongsToEducationalClass->name;
        })
        ->editColumn('price', function ($scheduleSession) {
            return $scheduleSession->price;
        })
        ->editColumn('ended_at', function ($scheduleSession) {
            return date('Y-m-d h:i a', strtotime($scheduleSession->ended_at));
        })
        ->editColumn('is_withdrawn', function ($scheduleSession) {
            
            return $scheduleSession->isWithdrawn == null ? '<span class="font-weight-bold text-success">تم سحبها</span>' : '<span class="font-weight-bold text-danger">لم يتم سحبها</span>';
        })
        ->rawColumns(['is_withdrawn'])
        ->make(true);
    }
}
