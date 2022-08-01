<?php

namespace App\Http\Controllers\Admin\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;
use App\Models\Instructor;
use Illuminate\Support\Facades\Auth;

class InstructorController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin.auth:admin');
    }

    public function index()
    {
        return view('admin.pages.instructor.index');
    }

    public function create()
    {
        return view('admin.pages.instructor.create');
    }

    public function show($slug)
    {
        $instructor = Instructor::where('slug', $slug)->first();
        return view('admin.pages.instructor.show')->with('instructor', $instructor);
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
        ->editColumn('created_at', function ($instructor) {
            return date('Y-m-d h:i a', strtotime($instructor->created_at));
        })
        ->rawColumns(['name'])
        ->make(true);
    }

    // Create New Instructor
    public function createInstructor(Request $request)
    {
        $name = $request->input('instructor_name');
        $email = $request->input('instructor_email');
        $gender = $request->input('gender');
        $password = $request->input('password');
        $confirm_password = $request->input('confirm_password');
        $image = null;
        $slug = md5(uniqid());

        Instructor::where('email', $email)->first() != null ? $this->errorMsg('هذا الحساب موجود من فضلك قم باختيار بريد الكتروني اخر') : true;

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
            // get instructor path 
            $instructor_path = public_path('uploads'.DIRECTORY_SEPARATOR.'instructors'.DIRECTORY_SEPARATOR.$slug.DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'personal-image');

            // get new image name
            $image_name = md5(uniqid());

            // upload image to instructor path
            $this->uploadFile($request, 'image', $instructor_path, $image_name);

            $image = $image_name.'.'.$request->file('image')->getClientOriginalExtension();
        }

        Instructor::create([
            'name' => $name,
            'email' => $email,
            'gender' => $gender,
            'password' => Hash::make($password),
            'image' => $image,
            'slug' => $slug,
        ]);

        $this->successMsg('تم انشاء حساب مدرس');

        $this->redierctTo('admin/instructor/'.$slug);
    }

    public function canPublishSessions(Request $request)
    {
        $canPublish = $request->input('canPublish');
        $instructor = Instructor::where('id', $request->input('instructor_id'))->first();

        return $canPublish == 1 ? view('admin.pages.instructor.can-publish-session')->with('instructor', $instructor) : null;
    }

    // Update Instructor Info
    public function updateInfo(Request $request)
    {
        $instructor_id = $request->input('instructor_id');
        $name = $request->input('instructor_name');
        $email = $request->input('instructor_email');
        $gender = $request->input('gender');
        $canPublishSession = $request->input('can_publish_session') == null ? 0 : 1;
        $number_of_sessions = $request->input('number_of_sessions');

        Instructor::where('id', $instructor_id)->update([
            'name' => $name,
            'email' => $email,
            'gender' => $gender,
            'can_publish_session' => $canPublishSession,
            'number_of_sessions' => $canPublishSession == 0 ? null : $number_of_sessions,
        ]);

        $male_or_female = $gender == '1' ? 'المدرس' : 'المدرسة';

        $this->successMsg('تم تحديث بيانات '.$male_or_female);
        
        $this->reloadPage();
    }

    // Update Instructor Image
    public function updateImage(Request $request)
    {
        $instructor = Instructor::where('id', $request->input('instructor_id'))->first();

        // get instructor path
        $instructor_path = public_path('uploads'.DIRECTORY_SEPARATOR.'instructors'.DIRECTORY_SEPARATOR.$instructor->slug.DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'personal-image');

        // check if instructor has an image
        if($instructor->image != null){
            // get old image
            $instructor_old_image = $instructor_path.DIRECTORY_SEPARATOR.$instructor->image;
            
            // remove old image if exists
            file_exists($instructor_old_image) ? $this->removeFile($instructor_old_image) : true;
        }

        // get new image name
        $image_name = md5(uniqid());

        // upload new image
        $this->uploadFile($request, 'image', $instructor_path, $image_name);

        // update image name in the database
        $instructor->update([
            'image' => $image_name.'.'.$request->file('image')->getClientOriginalExtension(),
        ]);

        $this->successMsg('تم تحديث الصورة الشخصية');

        $this->reloadPage();
    }

    // Remove Instructor Image
    public function removeImage(Request $request)
    {
        $instructor = Instructor::where('id', $request->input('instructor_id'))->first();

        // get instructor image
        $instructor_image = public_path('uploads'.DIRECTORY_SEPARATOR.'instructors'.DIRECTORY_SEPARATOR.$instructor->slug.DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'personal-image'.DIRECTORY_SEPARATOR.$instructor->image);

        // delete instructor image if exists
        file_exists($instructor_image) ? $this->removeFile($instructor_image) : true;

        // set instructor image into null 
        $instructor->update([
            'image' => null,
        ]);

        $this->successMsg('تمت ازاله الصورة الشخصية');

        $this->reloadPage();
    }
    
    // update instructor password
    public function updatePassword(Request $request)
    {
        $instructor = Instructor::where('id', $request->input('instructor_id'))->first();

        $current_password = $request->input('current_password');
        $new_password = $request->input('new_password');
        $confirm_password = $request->input('confirm_password');

        if(!Hash::check($current_password, $instructor->password)){

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

        $instructor->update([
            'password' => Hash::make($new_password),
        ]);

        $this->successMsg('تم تغيير كلمة السر الخاصة بالمدرس');
    }

    // permission to create book
    public function permissionToCreateBook(Request $request)
    {
        $instructor_id = $request->input('instructor_id');
        $permission = $request->input('permission');

        Instructor::where('id', $instructor_id)->update([
            'permission_to_create_book' => $permission,
        ]);

        $permission_msg = $permission == '0' ? 'تم الغاء صلاحية اضافة كتب' : 'تم اعطاء صلاحية اضافة كتب';

        $this->successMsg($permission_msg);
    }

    // delete instructor
    public function delete(Request $request)
    {
        $instructor = Instructor::where('id', $request->input('instructor_id'))->first();

        // get instructor path
        $instructor_path = public_path('uploads'.DIRECTORY_SEPARATOR.'instructors'.DIRECTORY_SEPARATOR.$instructor->slug);

        // remove instructor path if exists
        file_exists($instructor_path) ? $this->deleteDir($instructor_path) : true;

        // delete instructor form the database
        $instructor->delete();

        $this->successMsg('تم مسح هذا الحساب');

        $this->redierctTo('admin/instructors');
    }
}
