<?php

namespace App\Http\Controllers\Instructor\Pages;

use App\Http\Controllers\Controller;
use App\Models\EducationalStages\ScheduleSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionExcersiceController extends Controller
{
    public function __construct()
    {
        $this->middleware('instructor.auth:instructor');
    }

    public function index()
    {
        $scheduleSessionHomeworks = ScheduleSession::where('instructor_id', Auth::guard('instructor')->user()->id)
        ->where('homework', '!=', null)
        ->get();

        return view('instructor.pages.session-excersice.index')->with('scheduleSessionHomeworks', $scheduleSessionHomeworks);
    }
}
