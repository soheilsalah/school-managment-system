<?php

namespace App\Http\Controllers\Financial\Pages;

use App\Http\Controllers\Controller;
use App\Models\Expenses\Expense;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ExpenseController extends Controller
{
    public function __construct()
    {
        $this->middleware('financial.auth:financial');
    }

    public function index()
    {
        return view('financial.pages.expense.index');
    }

    public function datatable(Request $request)
    {
        $expense = Expense::get();

        return Datatables::of($expense)
        ->editColumn('service_name', function ($expense) {
            // return '<a href="'.route('admin.expense.service', $expense->slug).'">'.$expense->service_name.'</a>';
            return $expense->service_name;
        })
        ->editColumn('service_cost', function ($expense) {
            return $expense->service_cost;
        })
        ->editColumn('paid_every', function ($expense) {
            return $expense->duration_amount.' '.$expense->duration;
        })
        ->editColumn('start_from_date', function ($expense) {
            return date('Y-m-d', strtotime($expense->start_from_date));
        })
        ->editColumn('created_at', function ($expense) {
            return date('Y-m-d h:i a', strtotime($expense->created_at));
        })
        ->rawColumns(['service_name'])
        ->make(true);
    }
}
