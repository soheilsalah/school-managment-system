<?php

namespace App\Http\Controllers\Financial\Pages;

use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use App\Models\Parents\StudentParent;

class ParentController extends Controller
{
    public function __construct()
    {
        $this->middleware('financial.auth:financial');
    }

    public function index()
    {
        return view('financial.pages.parent.index');
    }

    // datatable to view all parents
    public function datatable()
    {
        $parent = StudentParent::get();

        return Datatables::of($parent)
        ->editColumn('name', function ($parent) {
            // return '<a href="'.route('admin.parent.show', $parent->slug).'">'.$parent->name.'</a>';
            return $parent->name;
        })
        ->editColumn('email', function ($parent) {
            return $parent->email;
        })
        ->editColumn('students', function ($parent) {
            return $parent->students->count();
        })
        ->editColumn('created_at', function ($parent) {
            return date('Y-m-d h:i a', strtotime($parent->created_at));
        })
        ->rawColumns(['name'])
        ->make(true);
    }
}
