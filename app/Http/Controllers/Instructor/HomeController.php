<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use App\Models\EducationalStages\EducationalStage;
use App\Models\EducationalStages\ScheduleSession;
use App\Models\EducationalStages\Term;
use App\Models\Instructors\InstructorClass;
use App\Models\Instructors\InstructorSubject;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('instructor.auth:instructor');
    }

    /**
     * Show the Instructor dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() {

        $educationalStages = EducationalStage::get();
        $scheduleSessions = ScheduleSession::where('instructor_id', Auth::guard('instructor')->user()->id)->get();

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

        $terms = Term::select('name', 'start_at', 'end_at')->get()->toArray();

        $term_info = 'لا يوجد فصل دراسي';

        for($i = 0; $i < count($terms); $i++){

            if(Carbon::now()->between($terms[$i]['start_at'], $terms[$i]['end_at'])){

                $term_info = [
                    'name' => $terms[$i]['name'],
                    'start_at' => $terms[$i]['start_at'],
                    'end_at' => $terms[$i]['end_at'],
                ];
            }
        }
        
        $countAllMySessions = ScheduleSession::where('instructor_id', Auth::guard('instructor')->user()->id)->count();
        $countMyEndedSessions = ScheduleSession::where('instructor_id', Auth::guard('instructor')->user()->id)->where('isEnded', 1)->count();
        $countMyNotEndedSessions = ScheduleSession::where('instructor_id', Auth::guard('instructor')->user()->id)->where('isEnded', 0)->count();
        $countMyClasses = InstructorClass::where('instructor_id', Auth::guard('instructor')->user()->id)->count();
        $countMySubjects = InstructorSubject::where('instructor_id', Auth::guard('instructor')->user()->id)->count();

        return view('instructor.home')
        ->with('educationalStages', $educationalStages)
        ->with('term_info', $term_info)
        ->with('countAllMySessions', $countAllMySessions)
        ->with('countMyEndedSessions', $countMyEndedSessions)
        ->with('countMyNotEndedSessions', $countMyNotEndedSessions)
        ->with('countMyClasses', $countMyClasses)
        ->with('countMySubjects', $countMySubjects)
        ->with('events', json_encode($events));
    }

    public function previewScheduleSession(Request $request)
    {
        $schedule_session_id = $request->input('id');

        $scheduleSession = ScheduleSession::where('id', $schedule_session_id)->first();

        $date = date('Y-m-d', strtotime($scheduleSession->start_at));
        list($start_time, $start_time_attr) = explode(' ', date('h:i a', strtotime($scheduleSession->start_at)));

        $start_time_attr = $start_time_attr == 'am' ? 'صباحا' : 'مساء';

        $start_session_route = route('instructor.session.start', $scheduleSession->start_url);
        $join_session_route = route('instructor.session.join', $scheduleSession->join_url);

        echo <<<HTML
        <h3 class="text-right">حصة بتاريخ {$date}</h3>
        <table class="table text-right">
            <thead>
                <tr>
                    <th>اسم الحصة</th>
                    <th>اسم المدرس</th>
                    <th>مواعيد بدء الحصة</th>
                    <th>مدة الحصة</th>
                    <th>سعر الحصة</th>
                    <th>رابط بدء الحصة</th>
                    <th>رابط الانضمام للحصة</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>$scheduleSession->topic</td>
                    <td>{$scheduleSession->belongsToInstructor->name}</td>
                    <td>$start_time $start_time_attr</td>
                    <td>{$scheduleSession->duration} دقيقة</td>
                    <td>{$scheduleSession->price} EGP</td>
                    <td>
                        <a href="{$start_session_route}" class="btn btn-success btn-sm" target="_blank">بدء الحصة</a>
                    </td>
                    <td>
                        <a href="{$join_session_route}" class="btn btn-info btn-sm" target="_blank">الانضمام</a>
                    </td>
                </tr>
            </tbody>
        </table>
        HTML;
    }
}
