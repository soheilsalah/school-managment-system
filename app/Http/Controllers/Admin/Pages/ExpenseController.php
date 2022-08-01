<?php

namespace App\Http\Controllers\Admin\Pages;

use App\Http\Controllers\Controller;
use App\Models\Expenses\Expense;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ExpenseController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin.auth:admin');
    }

    public function index()
    {
        return view('admin.pages.expense.index');
    }

    public function create()
    {
        return view('admin.pages.expense.create');
    }

    public function show($slug)
    {
        $expense = Expense::where('slug', $slug)->first();

        $expense == null ? abort(404) : true;

        return view('admin.pages.expense.show')->with('expense', $expense);
    }

    public function datatable(Request $request)
    {
        $expense = Expense::get();

        return Datatables::of($expense)
        ->editColumn('service_name', function ($expense) {
            return '<a href="'.route('admin.expense.service', $expense->slug).'">'.$expense->service_name.'</a>';
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

    // create new expense service
    public function createExpense(Request $request)
    {
        $service_name = $request->input('service_name');
        $service_cost = $request->input('service_cost');
        $duration_amount = $request->input('duration_amount');
        $duration = $request->input('duration');
        $start_from_date = $request->input('start_from_date');
        $slug = md5(uniqid());

        Expense::where('service_name', $service_name)->first() != null ? $this->errorMsg('لا يمكنك انشاء هذة الخدمة لانها موجودة مسبقا') : true;

        Expense::firstOrCreate(['service_name' => $service_name], [
            'service_name' => $service_name,
            'service_cost' => $service_cost,
            'duration_amount' => $duration_amount,
            'duration' => $duration,
            'start_from_date' => $start_from_date,
            'slug' => $slug,
        ]);

        $this->successMsg('تم انشاء خدمة <b>'.$service_name.'</b>');

        $this->redierctTo('admin/expense/service/'.$slug);
    }

    // update expense service
    public function updateExpense(Request $request)
    {
        $expense_id = $request->input('expense_id');

        $expense = Expense::where('id', $expense_id)->first();

        $service_name = $request->input('service_name');
        $service_cost = $request->input('service_cost');
        $duration_amount = $request->input('duration_amount');
        $duration = $request->input('duration');
        $start_from_date = $request->input('start_from_date');

        Expense::where('id', '!=', $expense_id)->where('service_name', $service_name)->first() != null ? $this->errorMsg('لا يمكنك انشاء هذة الخدمة لانها موجودة مسبقا') : true;

        Expense::where('id', $expense_id)->update([
            'service_name' => $service_name,
            'service_cost' => $service_cost,
            'duration_amount' => $duration_amount,
            'duration' => $duration,
            'start_from_date' => $start_from_date,
        ]);

        $this->successMsg('تم تحديث خدمة <b>'.$expense->service_name.'</b>');

        $this->reloadPage();
    }

    // delete expense service
    public function delete(Request $request)
    {
        Expense::where('id', $request->input('expense_id'))->delete();

        $this->successMsg('تم مسح هذة الخدمة');

        $this->redierctTo('admin/expenses');
    }
}
