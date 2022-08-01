<?php

namespace App\Http\Controllers\Financial;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('financial.auth:financial');
    }

    /**
     * Show the Financial dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() {
        return view('financial.home');
    }
}
