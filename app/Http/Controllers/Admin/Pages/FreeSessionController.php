<?php

namespace App\Http\Controllers\Admin\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\Students\FreeSession;
use App\Models\Students\Student;

class FreeSessionController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin.auth:admin');
    }

    public function index()
    {
        $students = Student::get();

        return view('admin.pages.free-session.index')->with('students', $students);
    }

    public function giveFreeSession(Request $request)
    {
        $student_id = $request->input('student_id');
        $number_of_free_sessions = $request->input('number_of_free_sessions');

        FreeSession::create([
            'student_id' => $student_id,
            'number_of_free_sessions' => $number_of_free_sessions
        ]);

        $this->successMsg('تم اعطاء هذا الطالب حصص مجانية');

        $this->reloadPage();
    }

    // datatable to view all financial role
    public function datatable()
    {
        $freeSession = FreeSession::get();

        return Datatables::of($freeSession)
        ->editColumn('student', function ($freeSession) {
            return '<a href="'.route('admin.student.show', $freeSession->belongsToStudent->slug).'">'.$freeSession->belongsToStudent->name.'</a>';
        })
        ->editColumn('number_of_free_sessions', function ($freeSession) {
            return '<input type="number" class="update-free-session" value="'.$freeSession->number_of_free_sessions.'" min="0" data-free-session-id="'.$freeSession->id.'"><small class="text-success font-weight-bold mr-3" id="free_session_'.$freeSession->id.'_res"></small>';
        })
        ->rawColumns(['student', 'number_of_free_sessions'])
        ->make(true);
    }

    public function updateNumberOfFreeSessions(Request $request)
    {
        $free_session_id = $request->input('free_session_id');
        $number_of_free_sessions = (int)$request->input('number_of_free_sessions');

        FreeSession::where('id', $free_session_id)->update([
            'number_of_free_sessions' => $number_of_free_sessions < 0 ? 0 : $number_of_free_sessions,
        ]);

        echo $number_of_free_sessions < 0 ? 'تم اعطاء عدد 0 حصة مجانية' : 'تم اعطاء عدد '.$number_of_free_sessions.' حصة مجانية';
    }
}
