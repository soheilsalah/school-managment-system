<?php

namespace App\Http\Controllers\Instructor\Pages;

use App\Http\Controllers\Controller;
use App\Models\Instructor;
use App\Models\Instructors\InstructorReward;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class RewardsAndIncentivesController extends Controller
{
    public function __construct()
    {
        $this->middleware('instructor.auth:instructor');
    }

    public function index()
    {
        return view('instructor.pages.rewards-and-incentives.index');
    }

    // datatable to view all instructor reward(s)
    public function instructorRewardDatatable()
    {
        $instructorReward = Instructor::where('id', Auth::guard('instructor')->user()->id)->first()->rewards;

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
        ->rawColumns(['isWithdrawn'])
        ->make(true);
    }
}