<?php

namespace App\Http\Controllers\Admin\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;
use App\Models\FinancialRole;
use Illuminate\Support\Facades\Hash;

class FinancialRoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin.auth:admin');
    }

    public function index()
    {
        return view('admin.pages.financial-role.index');
    }

    public function create()
    {
        return view('admin.pages.financial-role.create');
    }

    public function show($slug)
    {
        $financialRole = FinancialRole::where('slug', $slug)->first();

        return view('admin.pages.financial-role.show')->with('financialRole', $financialRole);
    }

    // datatable to view all financial role
    public function datatable()
    {
        $financialRole = FinancialRole::get();

        return Datatables::of($financialRole)
        ->editColumn('name', function ($financialRole) {
            return '<a href="'.route('admin.financial-role.show', $financialRole->slug).'">'.$financialRole->name.'</a>';
        })
        ->editColumn('email', function ($financialRole) {
            return $financialRole->email;
        })
        ->editColumn('created_at', function ($financialRole) {
            return date('Y-m-d h:i a', strtotime($financialRole->created_at));
        })
        ->rawColumns(['name'])
        ->make(true);
    }

    // Create New financial role
    public function createFinancialRole(Request $request)
    {
        $name = $request->input('financial_role_name');
        $email = $request->input('financial_role_email');
        $gender = $request->input('gender');
        $password = $request->input('password');
        $confirm_password = $request->input('confirm_password');
        $image = null;
        $slug = md5(uniqid());

        FinancialRole::where('email', $email)->first() != null ? $this->errorMsg('هذا الحساب موجود من فضلك قم باختيار بريد الكتروني اخر') : true;

        // check if password is less than 6 characters
        if(strlen($password) < 6){

            $this->errorMsg('يجب ان تكون كلمة السر مكونة من 6 رموز علي الاقل');
        }

        // check if password is not matched
        if($password !== $confirm_password){

            $this->errorMsg('كلمة السر غير متطابقة');
        }

        // check if image has been choosen
        if($request->hasFile('image')){
            // get financial role path 
            $financial_role_path = public_path('uploads'.DIRECTORY_SEPARATOR.'financial-roles'.DIRECTORY_SEPARATOR.$slug.DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'personal-image');

            // get new image name
            $image_name = md5(uniqid());

            // upload image to financial role path
            $this->uploadFile($request, 'image', $financial_role_path, $image_name);

            $image = $image_name.'.'.$request->file('image')->getClientOriginalExtension();
        }

        FinancialRole::create([
            'name' => $name,
            'email' => $email,
            'gender' => $gender,
            'password' => Hash::make($password),
            'image' => $image,
            'slug' => $slug,
        ]);

        $this->successMsg('تم انشاء حساب المسؤول المالي');

        $this->redierctTo('admin/financial-role/show/'.$slug);
    }

    // Update financial role Info
    public function updateInfo(Request $request)
    {
        $financial_role_id = $request->input('financial_role_id');
        $name = $request->input('financial_role_name');
        $email = $request->input('financial_role_email');
        $gender = $request->input('gender');

        FinancialRole::where('id', $financial_role_id)->update([
            'name' => $name,
            'email' => $email,
            'gender' => $gender,
        ]);

        $male_or_female = $gender == '1' ? 'مسؤول مالي' : 'مسؤولة مالية';

        $this->successMsg('تم تحديث بيانات '.$male_or_female);
        
        $this->reloadPage();
    }

    // Update Financial Role Image
    public function updateImage(Request $request)
    {
        $financialRole = FinancialRole::where('id', $request->input('financial_role_id'))->first();

        // get Financial Role path
        $financial_role_path = public_path('uploads'.DIRECTORY_SEPARATOR.'financial-roles'.DIRECTORY_SEPARATOR.$financialRole->slug.DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'personal-image');

        // check if Financial Role has an image
        if($financialRole->image != null){
            // get old image
            $financial_role_old_image = $financial_role_path.DIRECTORY_SEPARATOR.$financialRole->image;
            
            // remove old image if exists
            file_exists($financial_role_old_image) ? $this->removeFile($financial_role_old_image) : true;
        }

        // get new image name
        $image_name = md5(uniqid());

        // upload new image
        $this->uploadFile($request, 'image', $financial_role_path, $image_name);

        // update image name in the database
        $financialRole->update([
            'image' => $image_name.'.'.$request->file('image')->getClientOriginalExtension(),
        ]);

        $this->successMsg('تم تحديث الصورة الشخصية');

        $this->reloadPage();
    }

    // Remove Financial Role Image
    public function removeImage(Request $request)
    {
        $financialRole = FinancialRole::where('id', $request->input('financial_role_id'))->first();

        // get financial role image
        $financial_role_image = public_path('uploads'.DIRECTORY_SEPARATOR.'financial-roles'.DIRECTORY_SEPARATOR.$financialRole->slug.DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'personal-image'.DIRECTORY_SEPARATOR.$financialRole->image);

        // delete financial role image if exists
        file_exists($financial_role_image) ? $this->removeFile($financial_role_image) : true;

        // set financial role image into null 
        $financialRole->update([
            'image' => null,
        ]);

        $this->successMsg('تمت ازاله الصورة الشخصية');

        $this->reloadPage();
    }

    // update Financial Role password
    public function updatePassword(Request $request)
    {
        $financialRole = FinancialRole::where('id', $request->input('financial_role_id'))->first();

        $current_password = $request->input('current_password');
        $new_password = $request->input('new_password');
        $confirm_password = $request->input('confirm_password');

        if(!Hash::check($current_password, $financialRole->password)){

            $this->errorMsg('كلمة السر الحالية غير صحيحة');
        }

        if(strlen($new_password) < 6){

            $this->errorMsg('كلمة السر الجديدة يجب ان تكون اكثر 5 رموز');
        }

        if($new_password !== $confirm_password){

            $this->errorMsg('كلمة السر الجديدة غير متطابقة');
        }

        if($new_password === $current_password){

            $this->errorMsg('لا يمكنك استخدام كلمة السر الحالية ككلمة سر جديدة');
        }

        $financialRole->update([
            'password' => Hash::make($new_password),
        ]);

        $this->successMsg('تم تغيير كلمة السر الخاصة بالمسؤول المالي');
    }

    // delete Financial Role
    public function delete(Request $request)
    {
        $financialRole = FinancialRole::where('id', $request->input('financial_role_id'))->first();

        // get financial role path
        $financial_role_path = public_path('uploads'.DIRECTORY_SEPARATOR.'financial-roles'.DIRECTORY_SEPARATOR.$financialRole->slug);

        // remove instructor path if exists
        file_exists($financial_role_path) ? $this->deleteDir($financial_role_path) : true;

        // delete financial role form the database
        $financialRole->delete();

        $this->successMsg('تم مسح هذا الحساب');

        $this->redierctTo('admin/financial-roles');
    }
}
