<?php

namespace App\Http\Controllers\Student\Pages;

use App\Http\Controllers\Controller;
use App\Models\EducationalStages\AbscenseAndAttendance;
use App\Models\EducationalStages\ClassRoom;
use App\Models\EducationalStages\ClassRoomSchedule;
use App\Models\EducationalStages\ClassRoomSession;
use App\Models\EducationalStages\EducationalClass;
use App\Models\EducationalStages\EducationalClassTerm;
use App\Models\EducationalStages\EducationalStage;
use App\Models\EducationalStages\ScheduleSession;
use App\Models\Instructor;
use App\Models\Instructors\InstructorClass;
use App\Models\Instructors\InstructorSubject;
use App\Models\Students\StudentClass;
use App\Models\Subjects\Subject;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\Auth;
use Mockery\Matcher\Subset;

class ScheduleSessionController extends Controller
{
    public function __construct()
    {
        $this->middleware('student.auth:student');
    }

    public function index()
    {
        $instructorClasses = InstructorClass::where('instructor_id', Auth::guard('instructor')->user()->id)->get();

        return view('student.pages.schedule-session.index')->with('instructorClasses', $instructorClasses);
    }

    public function show($slug)
    {
        $scheduleSession = ScheduleSession::where('slug', $slug)->first();

        $scheduleSession == null ? abort(404) :  true;
        
        return view('student.pages.schedule-session.show')->with('scheduleSession', $scheduleSession);
    }

    public function joinSession($join_url)
    {
        $scheduleSession = ScheduleSession::where('join_url', $join_url)->first();

        $scheduleSession == null ? abort(404) : true;

        $scheduleSession->isStarted == null || $scheduleSession->isStarted != 1 ? abort(404) : true;

        $sessionWillEndAt = Carbon::createFromFormat('Y-m-d H:i:s', $scheduleSession->end_at);

        $abscenseAndAttendance = AbscenseAndAttendance::where('schedule_session_id', $scheduleSession->id)->where('student_id', Auth::guard('student')->user()->id)->first();

        $abscenseAndAttendance->update([
            'hasJoined' => 1,
            'joined_at' => Carbon::now(),
        ]);

        if($sessionWillEndAt->lt(Carbon::now())){
            
            $scheduleSession->update([
                'isEnded' => 1,
                'started_at' => $scheduleSession->started_at == null ? $scheduleSession->start_at : $scheduleSession->started_at,
                'ended_at' => Carbon::now(),
            ]);

        }elseif($scheduleSession->ended_at != null){

            $scheduleSession->update([
                'isEnded' => 1,
            ]);

        }else{

            $scheduleSession->update([
                'isEnded' => 0,
                'started_at' => $scheduleSession->started_at == null ? $scheduleSession->start_at : $scheduleSession->started_at,
            ]);
        }
        
        return view('student.pages.schedule-session.join-session')
        ->with('scheduleSession', $scheduleSession)
        ->with('abscenseAndAttendance', $abscenseAndAttendance);
    }

    public function leaveSession(Request $request)
    {
        $schedule_session_id = $request->input('schedule_session_id');
        $student_id = $request->input('student_id');

        $scheduleSession = ScheduleSession::where('id', $schedule_session_id)->first();

        $sessionWillEndAt = Carbon::createFromFormat('Y-m-d H:i:s', $scheduleSession->end_at);

        $abscenseAndAttendance = AbscenseAndAttendance::where('schedule_session_id', $schedule_session_id)->where('student_id', $student_id)->first();

        if($sessionWillEndAt->gt(Carbon::now())){

            $abscenseAndAttendance->update([
                'hasLeft' => 1,
                'left_at' => Carbon::now(),
            ]);

        }else{

            $abscenseAndAttendance->update([
                'endedByHost' => 1,
            ]);
        }

        $this->successMsg('تمت مغادرة الحصة');

        $this->reloadPage();
    }
}
