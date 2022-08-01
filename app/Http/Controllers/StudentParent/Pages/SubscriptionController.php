<?php

namespace App\Http\Controllers\StudentParent\Pages;

use App\Http\Controllers\Controller;
use App\Models\EducationalStages\EducationalClass;
use App\Models\EducationalStages\EducationalClassSubscription;
use App\Models\EducationalStages\ScheduleSession;
use App\Models\Students\Student;
use App\Models\Students\StudentClass;
use App\Models\Subjects\EducationalClassSubject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubscriptionController extends Controller
{
    public function __construct()
    {
        $this->middleware('parent.auth:parent');
    }

    public function index($student_slug)
    {
        $student = Student::where('slug', $student_slug)->first();

        $studentClass = StudentClass::where('student_id', $student->id)->first();

        return view('parent.pages.subscription.index')->with('studentClass', $studentClass);
    }

    public function checkout($plan_type)
    {
        $studentClass = StudentClass::where('student_id', Auth::guard('student')->user()->id)->first();
        $educationalClassSubscription = EducationalClassSubscription::where('educational_class_id', $studentClass->educational_class_id)->first();

        $educationalClassSubscription->{$plan_type} == null ? abort(404) : null;

        switch ($plan_type){
            case 'one_month':
                $plan_type_title = 'النظام الشهري';
            break;

            case 'three_months':
                $plan_type_title = 'نظام كل ثلاثة اشهر';
            break;

            case 'six_months':
                $plan_type_title = 'نظام كل ستة اشهر';
            break;

            case 'one_year':
                $plan_type_title = 'النظام السنوي';
            break;
        }

        return view('parent.pages.subscription.checkout')
        ->with('educationalClassSubscription', $educationalClassSubscription)
        ->with('studentClass', $studentClass)
        ->with('plan_type', $plan_type)
        ->with('plan_type_title', $plan_type_title);
    }

    public function previewSubscriptionPlans(Request $request)
    {
        $plan = $request->input('plan');
        $educational_class_id = $request->input('educational_class_id');

        switch ($plan) {
            case 'all_subject':
                $educationalClassSubscription = EducationalClassSubscription::where('educational_class_id', $educational_class_id)->first();

                return view('parent.pages.subscription.preview.montly_subscription')->with('educationalClassSubscription', $educationalClassSubscription);
            break;

            case 'specific_subject':
                $educationalClassSubjects = EducationalClassSubject::where('educational_class_id', $educational_class_id)->get();
                $educationalClass = EducationalClass::where('id', $educational_class_id)->first();

                return view('parent.pages.subscription.preview.subject')
                ->with('educationalClassSubjects', $educationalClassSubjects)
                ->with('educationalClass', $educationalClass);
            break;

            case 'specific_session':
                $scheduleSessions = ScheduleSession::where('educational_class_id', $educational_class_id)->get();
                $educationalClass = EducationalClass::where('id', $educational_class_id)->first();
                
                return view('parent.pages.subscription.preview.session')
                ->with('scheduleSessions', $scheduleSessions)
                ->with('educationalClass', $educationalClass);
            break;
        }
    }

    public function selectedSesssions(Request $request)
    {
        $schedule_sessions_id = $request->input('schedule_sessions');

        if($schedule_sessions_id != null && count($schedule_sessions_id) > 0){

            $scheduleSessions = ScheduleSession::whereIn('id', $schedule_sessions_id)->get();
    
            $html = '';
            $sum = 0;
    
            foreach($scheduleSessions as $scheduleSession){
    
                $sum += $scheduleSession->price;
    
                $html .= <<<HTML
                <tr>
                    <td>$scheduleSession->topic</td>
                    <td>$scheduleSession->price</td>
                </tr>
                
                HTML;
            }
    
            $html .= <<<HTML
            <tr>
                <th colspan="1" class="text-right font-size-24 font-weight-700">الاجمالي</th>
                <th class="font-size-24 font-weight-700" id="sum" data-sum="$sum">EGP $sum</th>
            </tr>
            HTML;
    
            echo $html;
        }else{

            return null;
        }
    }

    public function selectedSubjects(Request $request)
    {
        $subjects_id = $request->input('subjects');

        if($subjects_id != null && count($subjects_id) > 0){

            $educationalClassSubjects =EducationalClassSubject::whereIn('subject_id', $subjects_id)->get();

            $html = '';
            $sum = 0;

            foreach($educationalClassSubjects as $educationalClassSubject){
                
                $price = ScheduleSession::where('subject_id', $educationalClassSubject->subject_id)->sum('price');

                $html .= <<<HTML
                <tr>
                    <td>{$educationalClassSubject->belongsToSubject->name}</td>
                    <td>{$price}</td>
                </tr>
                HTML;

                $sum += $price;
            }

            $html .= <<<HTML
            <tr>
                <th colspan="1" class="text-right font-size-24 font-weight-700">الاجمالي</th>
                <th class="font-size-24 font-weight-700" id="sum" data-sum="$sum">EGP $sum</th>
            </tr>
            HTML;

            echo $html;
        }else{
            return null;
        }
    }
}
