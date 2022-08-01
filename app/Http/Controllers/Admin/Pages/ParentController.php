<?php

namespace App\Http\Controllers\Admin\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;
use App\Models\Parents\StudentParent;

class ParentController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin.auth:admin');
    }

    public function index()
    {
        return view('admin.pages.parent.index');
    }

    public function create()
    {
        return view('admin.pages.parent.create');
    }

    public function show($slug)
    {
        $parent = StudentParent::where('slug', $slug)->first();
        
        return view('admin.pages.parent.show')->with('parent', $parent);
    }

    // datatable to view all parents
    public function datatable()
    {
        $parent = StudentParent::get();

        return Datatables::of($parent)
        ->editColumn('name', function ($parent) {
            return '<a href="'.route('admin.parent.show', $parent->slug).'">'.$parent->name.'</a>';
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

    // Create New Parent
    public function createParent(Request $request)
    {
        $name = $request->input('parent_name');
        $email = $request->input('parent_email');
        $gender = $request->input('gender');
        $password = $request->input('password');
        $confirm_password = $request->input('confirm_password');
        $image = null;
        $slug = md5(uniqid());

        StudentParent::where('email', $email)->first() != null ? $this->errorMsg('هذا الحساب موجود من فضلك قم باختيار بريد الكتروني اخر') : true;

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
            // get parent path 
            $parent_path = public_path('uploads'.DIRECTORY_SEPARATOR.'parents'.DIRECTORY_SEPARATOR.$slug.DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'personal-image');

            // get new image name
            $image_name = md5(uniqid());

            // upload image to parent path
            $this->uploadFile($request, 'image', $parent_path, $image_name);

            $image = $image_name.'.'.$request->file('image')->getClientOriginalExtension();
        }

        StudentParent::create([
            'name' => $name,
            'email' => $email,
            'gender' => $gender,
            'password' => Hash::make($password),
            'image' => $image,
            'slug' => $slug,
        ]);

        $this->successMsg('تم انشاء حساب لولي الأمر');

        $this->redierctTo('admin/parent/'.$slug);
    }

    // Update Parent Info
    public function updateInfo(Request $request)
    {
        $parent_id = $request->input('parent_id');
        $name = $request->input('parent_name');
        $email = $request->input('parent_email');
        $gender = $request->input('gender');

        StudentParent::where('id', $parent_id)->update([
            'name' => $name,
            'email' => $email,
            'gender' => $gender,
        ]);

        $this->successMsg('تم تحديث بيانات ولي الأمر');
        
        $this->reloadPage();
    }

    // Update Parent Image
    public function updateImage(Request $request)
    {
        $parent = StudentParent::where('id', $request->input('parent_id'))->first();

        // get parent path
        $parent_path = public_path('uploads'.DIRECTORY_SEPARATOR.'parents'.DIRECTORY_SEPARATOR.$parent->slug.DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'personal-image');

        // check if parent has an image
        if($parent->image != null){
            // get old image
            $parent_old_image = $parent_path.DIRECTORY_SEPARATOR.$parent->image;
            
            // remove old image if exists
            file_exists($parent_old_image) ? $this->removeFile($parent_old_image) : true;
        }

        // get new image name
        $image_name = md5(uniqid());

        // upload new image
        $this->uploadFile($request, 'image', $parent_path, $image_name);

        // update image name in the database
        $parent->update([
            'image' => $image_name.'.'.$request->file('image')->getClientOriginalExtension(),
        ]);

        $this->successMsg('تم تحديث الصورة الشخصية');

        $this->reloadPage();
    }

    // Remove Parent Image
    public function removeImage(Request $request)
    {
        $parent = StudentParent::where('id', $request->input('parent_id'))->first();

        // get parent image
        $parent_image = public_path('uploads'.DIRECTORY_SEPARATOR.'parents'.DIRECTORY_SEPARATOR.$parent->slug.DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'personal-image'.DIRECTORY_SEPARATOR.$parent->image);

        // delete parent image if exists
        file_exists($parent_image) ? $this->removeFile($parent_image) : true;

        // set parent image into null 
        $parent->update([
            'image' => null,
        ]);

        $this->successMsg('تمت ازاله الصورة الشخصية');

        $this->reloadPage();
    }

    // update parent password
    public function updatePassword(Request $request)
    {
        $parent = StudentParent::where('id', $request->input('parent_id'))->first();

        $current_password = $request->input('current_password');
        $new_password = $request->input('new_password');
        $confirm_password = $request->input('confirm_password');

        if(!Hash::check($current_password, $parent->password)){

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

        $parent->update([
            'password' => Hash::make($new_password),
        ]);

        $this->successMsg('تم تغيير كلمة السر الخاصة بولي الأمر');
    }

    // delete parent
    public function delete(Request $request)
    {
        $parent = StudentParent::where('id', $request->input('parent_id'))->first();

        // get parent path
        $parent_path = public_path('uploads'.DIRECTORY_SEPARATOR.'parents'.DIRECTORY_SEPARATOR.$parent->slug);

        // remove parent path if exists
        file_exists($parent_path) ? $this->deleteDir($parent_path) : true;

        // delete parent form the database
        $parent->delete();

        $this->successMsg('تم مسح هذا الحساب');

        $this->redierctTo('admin/parents');
    }
}
