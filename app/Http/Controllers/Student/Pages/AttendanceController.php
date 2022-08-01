<?php

namespace App\Http\Controllers\Student\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function __construct()
    {
        $this->middleware('student.auth:student');
    }

    public function attendance()
    {
        return view('student.pages.attendance_and_abscences.attendance');
    }

    public function abscences()
    {
        return view('student.pages.attendance_and_abscences.abscences');
    }
}
