<?php

namespace App\Http\Controllers\Financial\Pages;

use App\Http\Controllers\Controller;
use App\Models\Instructor;
use App\Models\Instructors\InstructorReward;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class RewardsAndIncentivesController extends Controller
{
    public function __construct()
    {
        $this->middleware('financial.auth:financial');
    }

    public function index()
    {
        return view('financial.pages.rewards-and-incentives.index');
    }

    public function show($slug)
    {
        $instructor = Instructor::where('slug', $slug)->first();

        return view('financial.pages.rewards-and-incentives.show')->with('instructor', $instructor);
    }

    // datatable to view all instructors
    public function datatable()
    {
        $instructor = Instructor::get();

        return Datatables::of($instructor)
        ->editColumn('name', function ($instructor) {
            return $instructor->name;
        })
        ->editColumn('email', function ($instructor) {
            return $instructor->email;
        })
        ->editColumn('rewards', function ($instructor) {
            return '<a href="'.route('financial.instructor.rewards', $instructor->slug).'">'.$instructor->rewards->count().'</a>';
        })
        ->rawColumns(['name', 'rewards'])
        ->make(true);
    }

    // datatable to view all instructor reward(s)
    public function instructorRewardDatatable($slug)
    {
        $instructorReward = Instructor::where('slug', $slug)->first()->rewards;

        return Datatables::of($instructorReward)
        ->editColumn('reward_name', function ($instructorReward) {
            return $instructorReward->reward_name;
        })
        ->editColumn('reward_amount', function ($instructorReward) {
            return $instructorReward->reward_amount;
        })
        ->editColumn('rewarded_at', function ($instructorReward) {
            return date('Y-m-d', strtotime($instructorReward->rewarded_at));
        })
        ->editColumn('isWithdrawn', function ($instructorReward) {
            return $instructorReward->isWithdrawn == null ? '<span class="text-danger font-weight-bold">لم يتم سحبها</span>' : '<i class="text-success font-weight-bold">تم سحبها</i>';
        })
        ->rawColumns(['isWithdrawn', 'delete'])
        ->make(true);
    }
}