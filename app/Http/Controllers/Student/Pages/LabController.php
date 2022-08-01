<?php

namespace App\Http\Controllers\Student\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Labs\Lab;
use App\Models\Students\Student;
use Illuminate\Support\Facades\Auth;

class LabController extends Controller
{
    public function __construct()
    {
        $this->middleware('student.auth:student');
    }

    public function index()
    {
        $student = Student::where('id', Auth::guard('student')->user()->id)->first();

        $labs = Lab::where('educational_class_id', $student->belongsToStudentClass->educational_class_id)->get();

        return view('student.pages.lab.index')->with('labs', $labs);
    }

    public function show($slug)
    {
        $lab = Lab::where('slug', $slug)->first();

        $lab == null ? abort(404) : true;

        return view('student.pages.lab.show')->with('lab', $lab);
    }
}
