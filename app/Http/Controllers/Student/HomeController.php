<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\EducationalStages\ClassRoomSchedule;
use App\Models\EducationalStages\EducationalClassTerm;
use App\Models\EducationalStages\ScheduleSession;
use App\Models\EducationalStages\Term;
use App\Models\Students\Student;
use App\Models\Students\StudentClass;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('student.auth:student');
    }

    /**
     * Show the Student dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $student = Student::where('id', Auth::guard('student')->user()->id)->first();
        
        $studentClass = StudentClass::where('student_id', Auth::guard('student')->user()->id)->first();

        $scheduleSessions = ScheduleSession::where('educational_class_id', $studentClass->educational_class_id)->get();

        $events = [];
        
        foreach($scheduleSessions as $scheduleSession){

            $events[] = [
                'id' => $scheduleSession->id,
                'title' => $scheduleSession->topic,
                'start' => date('Y-m-d', strtotime($scheduleSession->start_at)),
                'end' => date('Y-m-d', strtotime($scheduleSession->end_at)),
                'end' => date('Y-m-d', strtotime($scheduleSession->end_at)),
            ];
        }


        return view('student.home')
        ->with('student', $student)
        ->with('scheduleSessions', $scheduleSessions)
        ->with('events', json_encode($events));
    }

    public function previewClassroomSessions(Request $request)
    {
        $title = $request->input('title');
        $classroom_schedule_id = $request->input('classroom_schedule_id');


        $classRoomScheduleSessions = ClassRoomSchedule::where('id', $classroom_schedule_id)->first()->sessions;

        return view('student.pages.schedule-session.display-classroom-sessions')
        ->with('title', $title)
        ->with('classRoomScheduleSessions', $classRoomScheduleSessions);
    }

    public function previewScheduleSession(Request $request)
    {
        $schedule_session_id = $request->input('id');

        $scheduleSession = ScheduleSession::where('id', $schedule_session_id)->first();
        
        $date = date('Y-m-d', strtotime($scheduleSession->start_at));
        list($start_time, $start_time_attr) = explode(' ', date('h:i a', strtotime($scheduleSession->start_at)));

        $start_time_attr = $start_time_attr == 'am' ? 'صباحا' : 'مساء';

        $join_session = $scheduleSession->isStarted == 1 ? '<a href="'.route('student.session.join', $scheduleSession->join_url).'" class="btn btn-info btn-sm" target="_blank">الانضمام</a>' : '<a class="btn btn-danger">لم يتم بدء الحصة</a>';

        echo <<<HTML
        <h3 class="text-right">حصة بتاريخ {$date}</h3>
        <table class="table text-right">
            <thead>
                <tr>
                    <th>اسم الحصة</th>
                    <th>اسم المدرس</th>
                    <th>مواعيد بدء الحصة</th>
                    <th>مدة الحصة</th>
                    <th>رابط الانضمام للحصة</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>$scheduleSession->topic</td>
                    <td>{$scheduleSession->belongsToInstructor->name}</td>
                    <td>$start_time $start_time_attr</td>
                    <td>{$scheduleSession->duration} دقيقة</td>
                    <td>
                        {$join_session}
                    </td>
                </tr>
            </tbody>
        </table>
        HTML;
    }
}