<?php

namespace App\Http\Controllers\Admin\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;
use App\Models\EducationalStages\EducationalClass;
use App\Models\Subjects\EducationalClassSubject;
use App\Models\Subjects\Subject;

class SubjectController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin.auth:admin');
    }

    public function index()
    {
        $educationalClasses = EducationalClass::get();

        return view('admin.pages.subject.index')->with('educationalClasses', $educationalClasses);
    }

    // datatable to view all subjects
    public function datatable()
    {
        $subject = Subject::get();

        return Datatables::of($subject)
        ->editColumn('name', function ($subject) {
            return '<span contenteditable="true" class="update-subject-name" data-subject-id="'.$subject->id.'">'.$subject->name.'</span>';
        })
        ->editColumn('classess', function ($subject) {
            return $subject->classes->count();
        })
        ->editColumn('delete', function ($subject) {
            return '<button class="btn btn-danger delete-subject" data-subject-id="'.$subject->id.'">مسح المرحلة التعليمية</button>';
        })
        ->setRowClass(function ($subject) {
            return 'tr_'.$subject->id;
        })
        ->rawColumns(['name', 'delete'])
        ->make(true);
    }

    // create new subject and append subject in educational class or classes
    public function create(Request $request)
    {
        $subject_name = $request->input('subject_name');
        $educational_classes_id = $request->input('educational_classes_id');

        count($educational_classes_id) > 0 ? $this->errorMsg('اختر صف تعليمي واحد علي الاقل') : true;
        
        Subject::where('slug', Str::slug($subject_name))->first() != null ? $this->errorMsg('لا يمكنك تكرار اسم المادة التعليمية') : true;

        $subject = Subject::create([
            'name' => $subject_name,
            'slug' => Str::slug($subject_name),
        ]);
            
        for($i = 0; $i < count($educational_classes_id); $i++){

            EducationalClassSubject::create([
                'subject_id' => $subject->id,
                'educational_class_id' => $educational_classes_id[$i],
            ]);
        }

        $count_educational_classes = count($educational_classes_id);

        echo <<<HTML
        <script>
            var rowNode = $('#subjects').DataTable().row.add({
                "name": '<span contenteditable="true" class="update-subject-name" data-subject-id="{$subject->id}">{$subject_name}</span>',
                "classess": "{$count_educational_classes}",
                "delete" : '<button class="btn btn-danger delete-subject" data-subject-id="{$subject->id}">مسح المادة التعليمية</button>',
            }).draw().node();

            $(rowNode).addClass('tr_{$subject->id}');
        </script>
        HTML;
        
        $singular_or_plural = $count_educational_classes > 1 ? 'صفوف تعليمية' : 'صف تعليمي';

        $this->successMsg('تم انشاء مادة التعليمية و تمت  اضافتها في '.count($educational_classes_id).' '.$singular_or_plural);
    }

    // update subject name
    public function updateName(Request $request)
    {
        $subject_id = $request->input('subject_id');
        $subject_name = $request->input('subject_name');

        Subject::where('id', $subject_id)->update([
            'name' => $subject_name,
            'slug' => Str::slug($subject_name),
        ]);
    }

    // delete subject with it's educational classes
    public function delete(Request $request)
    {
        $subject_id = $request->input('subject_id');

        Subject::where('id', $subject_id)->delete();

        $this->successMsg('تم مسح المادة التعليمية');
    }
}
