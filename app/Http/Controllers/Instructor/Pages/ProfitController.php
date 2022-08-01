<?php

namespace App\Http\Controllers\Instructor\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfitController extends Controller
{
    public function __construct()
    {
        $this->middleware('instructor.auth:instructor');
    }

    public function books()
    {
        return view('instructor.pages.profit.my-books');
    }

    public function sessions()
    {
        
    }

    public function myBooksProfitDatatable()
    {
        # code...
    }
}
