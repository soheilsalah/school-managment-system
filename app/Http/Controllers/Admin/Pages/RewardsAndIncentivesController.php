<?php

namespace App\Http\Controllers\Admin\Pages;

use App\Http\Controllers\Controller;
use App\Models\Instructor;
use App\Models\Instructors\InstructorReward;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class RewardsAndIncentivesController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin.auth:admin');
    }

    public function index()
    {
        return view('admin.pages.rewards-and-incentives.index');
    }

    public function show($slug)
    {
        $instructor = Instructor::where('slug', $slug)->first();

        return view('admin.pages.rewards-and-incentives.show')->with('instructor', $instructor);
    }

    // datatable to view all instructors
    public function datatable()
    {
        $instructor = Instructor::get();

        return Datatables::of($instructor)
        ->editColumn('name', function ($instructor) {
            return '<a href="'.route('admin.instructor.show', $instructor->slug).'">'.$instructor->name.'</a>';
        })
        ->editColumn('email', function ($instructor) {
            return $instructor->email;
        })
        ->editColumn('rewards', function ($instructor) {
            return '<a href="'.route('admin.instructor.rewards', $instructor->slug).'">'.$instructor->rewards->count().'</a>';
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
        ->editColumn('delete', function ($instructorReward) {
            return '<button class="btn btn-danger remove-instructor-reward" data-instructor-reward-id="'.$instructorReward->id.'">ازاله المكافآة الخاصة بالمدرس</button>';
        })
        ->setRowClass(function ($instructorReward) {
            return 'tr_'.$instructorReward->id;
        })
        ->rawColumns(['isWithdrawn', 'delete'])
        ->make(true);
    }

    // create reward or rewards for instructor
    public function createInstructorReward(Request $request)
    {
        $instructor_id = $request->input('instructor_id');
        $rewards = $request->input('rewards');

        for($i = 0; $i < count($rewards); $i++){

            $reward_name = $rewards[$i]['reward_name'];
            $reward_amount = $rewards[$i]['reward_amount'];
            $rewarded_at = $rewards[$i]['rewarded_at'];

            $instructorReward = InstructorReward::create([
                'instructor_id' => $instructor_id,
                'reward_name' => $reward_name,
                'reward_amount' => $reward_amount,
                'rewarded_at' => $rewarded_at,
            ]);

            echo <<<HTML
            <script>
                var rowNode = $('#rewards').DataTable().row.add({
                    "reward_name": '{$reward_name}',
                    "reward_amount": '{$reward_amount}',
                    "rewarded_at": '{$rewarded_at}',
                    "isWithdrawn": '<span class="text-danger font-weight-bold">لم يتم سحبها</span>',
                    "delete" : '<button class="btn btn-danger remove-instructor-reward" data-instructor-reward-id="{$instructorReward->id}">ازاله المكافآة الخاصة بالمدرس</button>',
                }).draw().node();

                $(rowNode).addClass('tr_{$instructorReward->id}');
            </script>
            HTML;
        }

        $singular_or_plural = count($rewards) == 1 ? 'تم منح مكافآة للمدرس' : 'منح مكافآت للمدرس';

        $this->successMsg($singular_or_plural);
    }

    public function removeInstructorReward(Request $request)
    {
        $instructor_reward_id = $request->input('instructor_reward_id');

        InstructorReward::where('id', $instructor_reward_id)->delete();

        $this->successMsg('تم ازاله المكافآة');
    }
}