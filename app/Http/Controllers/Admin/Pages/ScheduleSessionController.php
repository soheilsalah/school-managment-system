<?php

namespace App\Http\Controllers\Admin\Pages;

use App\Http\Controllers\Controller;
use App\Http\Traits\MeetingZoomTrait;
use App\Models\EducationalStages\EducationalClass;
use Yajra\DataTables\DataTables;
use App\Models\EducationalStages\EducationalStage;
use App\Models\EducationalStages\ScheduleSession;
use App\Models\Instructor;
use App\Models\Instructors\InstructorClass;
use App\Models\Instructors\InstructorSubject;
use App\Models\Subjects\Subject;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use MacsiDigital\Zoom\Facades\Zoom;
use Illuminate\Support\Str;

class ScheduleSessionController extends Controller
{
    use MeetingZoomTrait;

    public function __construct()
    {
        $this->middleware('admin.auth:admin');
    }

    public function index()
    {
        return view('admin.pages.schedule-session.index');
    }

    public function create()
    {
        $educationalStages = EducationalStage::get();
        $instructors = Instructor::get();
        $subjects = Subject::get();

        return view('admin.pages.schedule-session.create')
        ->with('instructors', $instructors)
        ->with('educationalStages', $educationalStages)
        ->with('subjects', $subjects);
    }

    public function show($slug)
    {
        $scheduleSession = ScheduleSession::where('slug', $slug)->first();

        $scheduleSession == null ? abort(404) :  true;
        
        return view('admin.pages.schedule-session.show')->with('scheduleSession', $scheduleSession);
    }

    public function datatable()
    {
        $scheduleSession = ScheduleSession::get();

        return Datatables::of($scheduleSession)
        ->editColumn('educational_stage', function ($scheduleSession) {
            return $scheduleSession->belongsToEducationalStage->name;
        })
        ->editColumn('educational_class', function ($scheduleSession) {
            return $scheduleSession->belongsToEducationalClass->name;
        })
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
        ->editColumn('delete', function ($scheduleSession) {
            return '<button class="btn btn-danger btn-sm fa fa-trash delete-meeting" data-schedule-session-id="'.$scheduleSession->id.'"></button>';
        })
        ->setRowClass(function ($scheduleSession) {
            return 'tr_'.$scheduleSession->id;
        })
        ->rawColumns(['subject', 'start_url', 'join_url', 'delete'])
        ->make(true);
    }

    public function displayEducationalClasses(Request $request)
    {
        $educational_stage_id = $request->input('educational_stage_id');

        $educationalStage = EducationalStage::where('id', $educational_stage_id)->first();
        
        return view('admin.pages.schedule-session.display-classes')->with('educationalStage', $educationalStage);
    }

    public function isSessionRecurrsive(Request $request)
    {
        $is_recurrsive = $request->input('is_recurrsive');

        return $is_recurrsive == 1 ? view('admin.pages.schedule-session.is-recurrsive.recurrsive-session') : view('admin.pages.schedule-session.is-recurrsive.single-session');
    }

    public function createSession(Request $request)
    {
        $topic = $request->input('topic');
        $instructor_id = $request->input('instructor_id');
        $educational_stage_id = $request->input('educational_stage_id');
        $educational_class_id = $request->input('educational_class_id');
        $start_at = $request->input('start_at');
        $duration = $request->input('duration');
        $price = $request->input('price');
        $percentage_cut = $request->input('percentage_cut');
        $subject_id = $request->input('subject_id');
        $homework = null;

        if($request->input('is_recurrsive') != null){
            
            $days = $request->input('days');

            list($start_date, $end_date) = explode(' - ', $request->input('datarange'));
    
            date('Y-m-d', strtotime($start_date)) <= date('Y-m-d') ? $this->errorMsg('تاريخ بدء الحصة يجب ان يكون اكبر من التاريخ الحالي') : true;

            $days == null ? $this->errorMsg('يجب علي الاقل اختيار يوم واحد من ايام الاسابيع') : true;
            
            $weekDaysBetween = $this->weekDaysBetween(array_values($days), date('Y-m-d H:i', strtotime("$start_date $start_at")), date('Y-m-d H:i', strtotime("$end_date $start_at")));
            
            $scheduleEducationalClassSessions = ScheduleSession::where('educational_class_id',  $educational_class_id)->get();
            
            // check if educational class has sessions
            if($scheduleEducationalClassSessions->count() > 0){

                foreach($scheduleEducationalClassSessions as $scheduleEducationalClassSession){
                    
                    $session_start_at = Carbon::createFromFormat('Y-m-d H:i:s', $scheduleEducationalClassSession->start_at)->format('Y-m-d H:i:s');
                    $session_end_at = Carbon::createFromFormat('Y-m-d H:i:s', $scheduleEducationalClassSession->end_at)->format('Y-m-d H:i:s');

                    foreach($weekDaysBetween as $weekDay){
                        
                        Carbon::createFromFormat('Y-m-d H:i:s', $weekDay)->between($session_start_at, $session_end_at) ? $this->errorMsg('لا يمكنك انشاء حصة في هذا الميعاد لانة توجد حصة او حصص في هذا الميعاد') : true;

                        $duration_of_session_datetime = Carbon::createFromFormat('Y-m-d H:i:s', $weekDay)->addMinutes($duration)->format('Y-m-d H:i:s');

                        Carbon::createFromFormat('Y-m-d H:i:s', $duration_of_session_datetime)->between($session_start_at, $session_end_at) ? $this->errorMsg('لا يمكنك انشاء حصة في هذا الميعاد لانة توجد حصة او حصص في هذا الميعاد') : true;
                    }
                }
            }

            foreach($weekDaysBetween as $weekDay){

                $session_will_start_at = $weekDay;
                $session_will_end_at = Carbon::createFromFormat('Y-m-d H:i:s', $weekDay)->addMinutes($duration);

                ScheduleSession::create([
                    'topic' => $topic,
                    'instructor_id' => $instructor_id,
                    'meeting_id' => md5(uniqid()),
                    'educational_stage_id' => $educational_stage_id,
                    'educational_class_id' => $educational_class_id,
                    'start_at' => $session_will_start_at,
                    'duration' => $duration,
                    'end_at' => $session_will_end_at,
                    'password' => Str::random(8),
                    'start_url' => md5(uniqid()),
                    'join_url' => md5(uniqid()),
                    'price' => $price,
                    'subject_id' => $subject_id,
                    'slug' => md5(uniqid()),
                ]);
            }

        }else{

            date('Y-m-d', strtotime($request->input('date'))) <= date('Y-m-d') ? $this->errorMsg('تاريخ بدء الحصة يجب ان يكون اكبر من التاريخ الحالي') : true;
            
            $scheduleEducationalClassSessions = ScheduleSession::where('educational_class_id',  $educational_class_id)->get();

            $date = $request->input('date');

            $selected_session_datetime = date('Y-m-d H:i:s', strtotime("$date $start_at"));

            // check if educational class has sessions
            if($scheduleEducationalClassSessions->count() > 0){

                foreach($scheduleEducationalClassSessions as $scheduleEducationalClassSession){

                    $session_start_at = Carbon::createFromFormat('Y-m-d H:i:s', $scheduleEducationalClassSession->start_at)->format('Y-m-d H:i:s');
                    $session_end_at = Carbon::createFromFormat('Y-m-d H:i:s', $scheduleEducationalClassSession->end_at)->format('Y-m-d H:i:s');

                    Carbon::createFromFormat('Y-m-d H:i:s', $selected_session_datetime)->between($session_start_at, $session_end_at) ? $this->errorMsg('لا يمكنك انشاء حصة في هذا الميعاد لانة توجد حصة في هذا الميعاد') : true;

                    $duration_of_selected_session_datetime = Carbon::createFromFormat('Y-m-d H:i:s', $selected_session_datetime)->addMinutes($duration)->format('Y-m-d H:i:s');

                    Carbon::createFromFormat('Y-m-d H:i:s', $duration_of_selected_session_datetime)->between($session_start_at, $session_end_at) ? $this->errorMsg('لا يمكنك انشاء حصة في هذا الميعاد لانة توجد حصة في هذا الميعاد') : true;
                }
            }

            dd('good to go');
            
            die();
            
            $educationalStage = EducationalStage::where('id', $educational_stage_id)->first();
            $educationalClass = EducationalClass::where('id', $educational_class_id)->first();
            $instructor = Instructor::where('id', $instructor_id)->first();
    
            // upload homework if exists
            if($request->hasFile('homework')){
                
                $homework_path = public_path('uploads/homeworks/'.$educationalStage->slug.'/'.$educationalClass->slug.'/'.$instructor->slug);
    
                $homework_filename = md5(uniqid());
    
                $this->uploadFile($request, 'homework', $homework_path, $homework_filename);
    
                $homework = $homework_filename.'.'.$request->file('homework')->getClientOriginalExtension();
            }

            ScheduleSession::create([
                'topic' => $topic,
                'instructor_id' => $instructor_id,
                'meeting_id' => md5(uniqid()),
                'educational_stage_id' => $educational_stage_id,
                'educational_class_id' => $educational_class_id,
                'start_at' => $start_at,
                'duration' => $duration,
                'password' => md5(uniqid()),
                'start_url' => md5(uniqid()),
                'join_url' => md5(uniqid()),
                'price' => $price,
                'percentage_cut' => $percentage_cut,
                'subject_id' => $subject_id,
                'homework' => $homework,
                'slug' => md5(uniqid()),
            ]);
        }

        InstructorClass::firstOrCreate(['instructor_id' => $instructor_id, 'educational_class_id' => $educational_class_id],[
            'instructor_id' => $instructor_id,
            'subject_id' => $subject_id,
            'educational_class_id' => $educational_class_id,
        ]);

        InstructorSubject::firstOrCreate(['instructor_id' => $instructor_id, 'subject_id' => $subject_id],[
            'instructor_id' => $instructor_id,
            'subject_id' => $subject_id,
        ]);

        /* Uncomment this line of code if you want to connect to zoom api */
        // $meeting = $this->createMeeting($request);

        $this->successMsg('تم انشاء محاضرة جديدة');
    }

    private function weekDaysBetween($requiredDays, $start, $end)
    {
        $startTime = Carbon::createFromFormat('Y-m-d H:i', $start);
        $endTime = Carbon::createFromFormat('Y-m-d H:i', $end);

        $result = [];

        while ($startTime->lt($endTime)) {
        
            if(in_array($startTime->dayOfWeek, $requiredDays))
            {
                array_push($result, $startTime->copy());
            }
            
            $startTime->addDay();
        }
    
        return $result;
    }

    public function deleteSession(Request $request)
    {
        $scheduleSession = ScheduleSession::where('id', $request->input('schedule_session_id'))->first();

        // uncomment the code below if this session is connected to zoom
        /*$meeting = Zoom::meeting()->find($scheduleSession->meeting_id);
        $meeting->delete();*/

        $scheduleSession->delete();

        $this->successMsg('تم مسح هذة الحصة');
    }

    public function startSession($start_url)
    {
        $scheduleSession = ScheduleSession::where('start_url', $start_url)->first();

        $scheduleSession == null ? abort(404) : true;

        return view('admin.pages.schedule-session.start-session')->with('scheduleSession', $scheduleSession);
    }

    public function ajaxStartSession(Request $request)
    {
        $scheduleSession = ScheduleSession::where('id', $request->input('schedule_session_id'))->first();

        $scheduleSession->update([
            'isStarted' => 1,
            'started_at' => Carbon::now(),
        ]);

        $this->redierctTo('admin/schedule-session/join-session/'.$scheduleSession->join_url);
    }

    public function joinSession($join_url)
    {
        $scheduleSession = ScheduleSession::where('join_url', $join_url)->first();

        $scheduleSession == null ? abort(404) : true;

        $scheduleSession->isStarted == null || $scheduleSession->isStarted != 1 ? abort(404) : true;

        $sessionWillEndAt = Carbon::createFromFormat('Y-m-d H:i:s', $scheduleSession->end_at);

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
        
        return view('admin.pages.schedule-session.join-session')->with('scheduleSession', $scheduleSession);
    }

    public function endSession(Request $request)
    {
        $schedule_session_id = $request->input('schedule_session_id');

        ScheduleSession::where('id', $schedule_session_id)->update([
            'ended_at' => Carbon::now(),
            'isEnded' => 1,
        ]);

        $this->successMsg('لقد تم انهاء الحصة');

        $this->reloadPage();
    }
}
