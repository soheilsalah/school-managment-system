<?php

namespace App\Http\Controllers\Admin\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\EducationalStages\EducationalClass;
use App\Models\EducationalStages\EducationalStage;
use App\Models\Labs\Lab;
use App\Models\Subjects\Subject;
use Yajra\DataTables\DataTables;

class LabController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin.auth:admin');
    }

    public function index()
    {
        return view('admin.pages.lab.index');
    }

    public function show($slug)
    {
        $lab = Lab::where('slug', $slug)->first();

        $lab == null ? abort(404) : true;

        $educationalStages = EducationalStage::get();
        $subjects = Subject::get();

        return view('admin.pages.lab.show')
        ->with('lab', $lab)
        ->with('educationalStages', $educationalStages)
        ->with('subjects', $subjects);
    }

    public function create()
    {
        $educationalStages = EducationalStage::get();
        $subjects = Subject::get();
        
        return view('admin.pages.lab.create')
        ->with('educationalStages', $educationalStages)
        ->with('subjects', $subjects);
    }

    public function datatable()
    {
        $lab = Lab::get();

        return Datatables::of($lab)
        ->editColumn('name', function ($lab) {
            return '<a href="'.route('admin.lab.show', $lab->slug).'">'.$lab->name.'</a>';
        })
        ->editColumn('educational_stage', function ($lab) {
            return $lab->belongsToEducationalStage->name;
        })
        ->editColumn('educational_class', function ($lab) {
            return $lab->belongsToEducationalClass->name;
        })
        ->editColumn('subject', function ($lab) {
            return $lab->belongsToSubject->name;
        })
        ->rawColumns(['name'])
        ->make(true);
    }

    public function previewEducationalClasses(Request $request)
    {
        $educationalClasses = EducationalClass::where('educational_stage_id', $request->input('educational_stage_id'))->get();
        $lab_id = $request->input('lab_id');

        $lab = Lab::where('id', $lab_id)->first();
        
        return view('admin.pages.lab.preview.educational-classes')
        ->with('educationalClasses', $educationalClasses)
        ->with('lab', $lab);
    }

    public function createLab(Request $request)
    {
        $lab_name = $request->input('lab_name');
        $lab_url = $request->input('lab_url');
        $educational_stage_id = $request->input('educational_stage_id');
        $educational_class_id = $request->input('educational_class_id');
        $subject_id = $request->input('subject_id');
        $thumbnail = null;
        $slug = Str::slug($lab_name);

        if($request->hasFile('thumbnail')){

            // check extension
            $this->isFileExtAllowed(['png', 'jpg', 'jpeg'], $request->file('thumbnail')->getClientOriginalExtension(), 'يجب ان يكون صورة المعمل بالخاصية الاتية <br> <b>png, jpeg, jpg</b>');

            // rename thumbnail
            $thumbnail_name = md5(uniqid());

            // get thumbnail path
            $thumbnail_path = public_path('uploads/labs/'.$slug.'/thumbnail');

            // upload file
            $this->uploadFile($request, 'thumbnail', $thumbnail_path, $thumbnail_name);

            $thumbnail = $thumbnail_name.'.'.$request->file('thumbnail')->getClientOriginalExtension();
        }

        Lab::firstOrCreate(['slug' => $slug],[
            'name' => $lab_name,
            'link' => $lab_url,
            'educational_stage_id' => $educational_stage_id,
            'educational_class_id' => $educational_class_id,
            'subject_id' => $subject_id,
            'thumbnail' => $thumbnail,
            'slug' => $slug,
        ]);

        $this->successMsg('تم انشاء المعمل');

        $this->redierctTo('admin/lab/'.$slug.'/show');
    }

    public function updateInfo(Request $request)
    {
        $lab_id = $request->input('lab_id');
        $lab_name = $request->input('lab_name');
        $educational_stage_id = $request->input('educational_stage_id');
        $educational_class_id = $request->input('educational_class_id');
        $subject_id = $request->input('subject_id');

        Lab::where('id', $lab_id)->update([
            'name' => $lab_name,
            'educational_stage_id' => $educational_stage_id,
            'educational_class_id' => $educational_class_id,
            'subject_id' => $subject_id,
        ]);

        $this->successMsg('تم تحديث بيانات المعمل');
    }

    public function updateThumbnail(Request $request)
    {
        $lab_id = $request->input('lab_id');
        $thumbnail = $request->file('thumbnail');

        $lab = Lab::where('id', $lab_id)->first();

        // get thumbnail path
        $thumbnail_path = public_path('uploads'.DIRECTORY_SEPARATOR.'labs'.DIRECTORY_SEPARATOR.$lab->slug.DIRECTORY_SEPARATOR.'thumbnail');

        // remove old thumbnail if exists
        file_exists($thumbnail_path.DIRECTORY_SEPARATOR.$lab->thumbnail) ? $this->removeFile($thumbnail_path.DIRECTORY_SEPARATOR.$lab->thumbnail) : true;

        // get new thumbnail name
        $thumbnail_name = md5(uniqid());

        // upload new thumbnail
        $this->uploadFile($request, 'thumbnail', $thumbnail_path, $thumbnail_name);

        // update thumbnail in the database
        $lab->update([
            'thumbnail' => $thumbnail_name.'.'.$thumbnail->getClientOriginalExtension(),
        ]);

        $this->successMsg('تم تحديث صورة المعمل');

        $this->reloadPage();
    }

    public function updateLink(Request $request)
    {
        $lab_id = $request->input('lab_id');
        $lab_url = $request->input('lab_url');

        Lab::where('id', $lab_id)->update([
            'link' => $lab_url,
        ]);

        $this->successMsg('تم تحديث المعمل');

        $this->reloadPage();
    }

    public function deleteThumbnail(Request $request)
    {
        $lab = Lab::where('id', $request->input('lab_id'))->first();

        // get thumbnail path
        $thumbnail_path = public_path('uploads'.DIRECTORY_SEPARATOR.'labs'.DIRECTORY_SEPARATOR.$lab->slug.DIRECTORY_SEPARATOR.'thumbnail');

        // remove thumbnail directory if exits
        file_exists($thumbnail_path) ? $this->deleteDir($thumbnail_path) : true;

        $lab->update([
            'thumbnail' => null,
        ]);

        $this->successMsg('تم ازاله صورة المعمل');

        $this->reloadPage();
    }

    public function delete(Request $request)
    {
        $lab = Lab::where('id', $request->input('lab_id'))->first();

        // get thumbnail path
        $thumbnail_path = public_path('uploads'.DIRECTORY_SEPARATOR.'labs'.DIRECTORY_SEPARATOR.$lab->slug);

        // remove thumbnail directory if exits
        file_exists($thumbnail_path) ? $this->deleteDir($thumbnail_path) : true;

        $lab->delete();

        $this->successMsg('تم ازاله هذا المعمل');

        $this->redierctTo('admin/labs');
    }
}
