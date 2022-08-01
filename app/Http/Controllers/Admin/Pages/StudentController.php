<?php

namespace App\Http\Controllers\Admin\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;
use App\Models\Parents\StudentParent;
use App\Models\Students\Student;
use App\Models\EducationalStages\EducationalClass;
use App\Models\Parents\ParentStudent;
use App\Models\Students\StudentClass;

class StudentController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin.auth:admin');
    }

    public function index()
    {
        return view('admin.pages.student.index');
    }

    public function create()
    {
        $parents = StudentParent::get();
        $educationalClasses = EducationalClass::get();

        return view('admin.pages.student.create')
        ->with('parents', $parents)
        ->with('educationalClasses', $educationalClasses);
    }

    public function show($slug)
    {
        $student = Student::where('slug', $slug)->first();
        $parents = StudentParent::get();
        $educationalClasses = EducationalClass::get();

        $student == null ? abort(404) : true;

        return view('admin.pages.student.show')
        ->with('student', $student)
        ->with('parents', $parents)
        ->with('educationalClasses', $educationalClasses);
    }

    // datatable to view all students
    public function datatable()
    {
        $student = Student::get();

        return Datatables::of($student)
        ->editColumn('name', function ($student) {
            return '<a href="'.route('admin.student.show', $student->slug).'">'.$student->name.'</a>';
        })
        ->editColumn('email', function ($student) {
            return $student->email;
        })
        ->editColumn('educational_stage', function ($student) {
            return $student->belongsToStudentClass->belongsToEducationalStage->name;
        })
        ->editColumn('class', function ($student) {
            return $student->belongsToStudentClass->belongsToEducationalClass->name;
        })
        ->editColumn('parent', function ($student) {
            if ($student->parentStudent != null) {
                return '<a href="'.route('admin.parent.show', $student->parentStudent->belongsToParent->slug).'">'.$student->parentStudent->belongsToParent->name.'</a>';
            }else{
                return '<span class="text-danger font-weight-bold">لا يوجد ولي امر</span>';
            }
        })
        ->editColumn('created_at', function ($student) {
            return date('Y-m-d h:i a', strtotime($student->created_at));
        })
        ->rawColumns(['name', 'parent'])
        ->make(true);
    }

    // Create New Student
    public function createStudent(Request $request)
    {
        $name = $request->input('student_name');
        $email = $request->input('student_email');
        $gender = $request->input('gender');
        $parent_id = $request->input('parent_id');
        $educational_class_id = $request->input('educational_class_id');
        $password = $request->input('password');
        $confirm_password = $request->input('confirm_password');
        $image = null;
        $slug = md5(uniqid());

        Student::where('email', $email)->first() != null ? $this->errorMsg('هذا الحساب موجود من فضلك قم باختيار بريد الكتروني اخر') : true;

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
            // get student path 
            $student_path = public_path('uploads'.DIRECTORY_SEPARATOR.'students'.DIRECTORY_SEPARATOR.$slug.DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'personal-image');

            // get new image name
            $image_name = md5(uniqid());

            // upload image to student path
            $this->uploadFile($request, 'image', $student_path, $image_name);

            $image = $image_name.'.'.$request->file('image')->getClientOriginalExtension();
        }

        $student = Student::create([
            'name' => $name,
            'email' => $email,
            'gender' => $gender,
            'password' => Hash::make($password),
            'image' => $image,
            'slug' => $slug,
        ]);

        // append student to parent
        ParentStudent::firstOrCreate(['parent_id' => $parent_id, 'student_id' => $student->id],[
            'parent_id' => $parent_id,
            'student_id' => $student->id,
        ]);

        $educationalClass = EducationalClass::where('id', $educational_class_id)->first();

        // add student to educational class
        StudentClass::firstOrCreate(['student_id' => $student->id, 'educational_stage_id' => $educationalClass->belongsToEducationalStage->id, 'educational_class_id' => $educational_class_id],[
            'student_id' => $student->id,
            'educational_stage_id' => $educationalClass->belongsToEducationalStage->id,
            'educational_class_id' => $educational_class_id
        ]);

        $this->successMsg('تم انشاء حساب لطالب جديد');

        $this->redierctTo('admin/student/'.$slug);
    }

    // Update Student Info
    public function updateInfo(Request $request)
    {
        $student_id = $request->input('student_id');
        $name = $request->input('student_name');
        $email = $request->input('student_email');
        $gender = $request->input('gender');

        Student::where('id', $student_id)->update([
            'name' => $name,
            'email' => $email,
            'gender' => $gender,
        ]);

        $this->successMsg('تم تحديث بيانات هذا الطالب');
        
        $this->reloadPage();
    }

    // Update Student Parent
    public function updateParent(Request $request)
    {
        $student_id = $request->input('student_id');
        $parent_id = $request->input('parent_id');
        
        ParentStudent::updateOrCreate(['student_id' => $student_id], [
            'student_id' => $student_id,
            'parent_id' => $parent_id,
        ]);

        $this->successMsg('تم تغيير ولي أمر هذا الطالب');
    }

    // preview educational class classrooms
    public function previewEducationalClassClassRooms(Request $request)
    {
        $educational_class_id = $request->input('educational_class_id');

        $classrooms = EducationalClass::where('id', $educational_class_id)->first()->classrooms;

        return view('admin.pages.student.preview-classrooms')->with('classrooms', $classrooms);
    }

    // Update Educational Class for Student
    public function updateEducationalClass(Request $request)
    {
        $student_id = $request->input('student_id');
        $educational_class_id = $request->input('educational_class_id');
        $class_room_id = $request->input('classroom_id');
        
        $educationalClass = EducationalClass::where('id', $educational_class_id)->first();
        
        StudentClass::where('student_id', $student_id)->update([
            'educational_stage_id' => $educationalClass->belongsToEducationalStage->id,
            'educational_class_id' => $educational_class_id,
            'class_room_id' => $class_room_id,
        ]);

        $this->successMsg('تم تغيير الصف التعليمي لهذا الطالب');
    }

    // Update Student Image
    public function updateImage(Request $request)
    {
        $student = Student::where('id', $request->input('student_id'))->first();

        // get student path
        $student_path = public_path('uploads'.DIRECTORY_SEPARATOR.'students'.DIRECTORY_SEPARATOR.$student->slug.DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'personal-image');

        // check if student has an image
        if($student->image != null){
            // get old image
            $student_old_image = $student_path.DIRECTORY_SEPARATOR.$student->image;
            
            // remove old image if exists
            file_exists($student_old_image) ? $this->removeFile($student_old_image) : true;
        }

        // get new image name
        $image_name = md5(uniqid());

        // upload new image
        $this->uploadFile($request, 'image', $student_path, $image_name);

        // update image name in the database
        $student->update([
            'image' => $image_name.'.'.$request->file('image')->getClientOriginalExtension(),
        ]);

        $this->successMsg('تم تحديث الصورة الشخصية');

        $this->reloadPage();
    }

    // Remove Student Image
    public function removeImage(Request $request)
    {
        $student = Student::where('id', $request->input('student_id'))->first();

        // get student image
        $student_image = public_path('uploads'.DIRECTORY_SEPARATOR.'students'.DIRECTORY_SEPARATOR.$student->slug.DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'personal-image'.DIRECTORY_SEPARATOR.$student->image);

        // delete student image if exists
        file_exists($student_image) ? $this->removeFile($student_image) : true;

        // set student image into null 
        $student->update([
            'image' => null,
        ]);

        $this->successMsg('تمت ازاله الصورة الشخصية');

        $this->reloadPage();
    }

    // update Student password
    public function updatePassword(Request $request)
    {
        $student = Student::where('id', $request->input('student_id'))->first();

        $current_password = $request->input('current_password');
        $new_password = $request->input('new_password');
        $confirm_password = $request->input('confirm_password');

        if(!Hash::check($current_password, $student->password)){

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

        $student->update([
            'password' => Hash::make($new_password),
        ]);

        $this->successMsg('تم تغيير كلمة السر الخاصة بالطالب');
    }

    // delete student
    public function delete(Request $request)
    {
        $student = Student::where('id', $request->input('student_id'))->first();

        // get student path
        $student_path = public_path('uploads'.DIRECTORY_SEPARATOR.'students'.DIRECTORY_SEPARATOR.$student->slug);

        // remove student path if exists
        file_exists($student_path) ? $this->deleteDir($student_path) : true;

        // delete student form the database
        $student->delete();

        $this->successMsg('تم مسح هذا الحساب');

        $this->redierctTo('admin/students');
    }
}
