<?php

namespace App\Http\Controllers\Admin\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;
use App\Models\EducationalStages\EducationalStage;

class EducationalStageController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin.auth:admin');
    }

    public function index()
    {
        return view('admin.pages.educational-stage.index');
    }

    // datatable to view all educational stages
    public function datatable()
    {
        $educationalStage = EducationalStage::get();

        return Datatables::of($educationalStage)
        ->editColumn('name', function ($educationalStage) {
            return '<span contenteditable="true" class="update-educational-stage-name" data-educational-stage-id="'.$educationalStage->id.'">'.$educationalStage->name.'</span>';
        })
        ->editColumn('classess', function ($educationalStage) {
            return $educationalStage->classes->count();
        })
        ->editColumn('students', function ($educationalStage) {
            return '0';
        })
        ->editColumn('description', function ($educationalStage) {
            return '<span contenteditable="true" class="update-educational-stage-description" data-educational-stage-id="'.$educationalStage->id.'">'.$educationalStage->description.'</span>';
        })
        ->editColumn('delete', function ($educationalStage) {
            return '<button class="btn btn-danger delete-educational-stage" data-educational-stage-id="'.$educationalStage->id.'">مسح المرحلة التعليمية</button>';
        })
        ->setRowClass(function ($educationalStage) {
            return 'tr_'.$educationalStage->id;
        })
        ->rawColumns(['name', 'description', 'delete'])
        ->make(true);
    }

    // create new eductaional stage
    public function create(Request $request)
    {
        $educational_stage_name = $request->input('educational_stage_name');
        $educational_stage_description = $request->input('educational_stage_description');

        EducationalStage::where('slug', Str::slug($educational_stage_name))->first() != null ? $this->errorMsg('لا يمكنك تكرار مرحلة تعليمية بنفس الاسم') : true;

        $educationalStage = EducationalStage::create([
            'name' => $educational_stage_name,
            'description' => $educational_stage_description,
            'slug' => Str::slug($educational_stage_name),
        ]);

        echo <<<HTML
        <script>
            var rowNode = $('#educational-stages').DataTable().row.add({
                "name": '<span contenteditable="true" class="update-educational-stage-name" data-educational-stage-id="{$educationalStage->id}">{$educational_stage_name}</span>',
                "classess": "0",
                "students": "0",
                "description": '<span contenteditable="true" class="update-educational-stage-description" data-educational-stage-id="{$educationalStage->id}">{$educationalStage->description}</span>',
                "delete" : '<button class="btn btn-danger delete-educational-stage" data-educational-stage-id="{$educationalStage->id}">مسح المرحلة التعليمية</button>',
            }).draw().node();

            $(rowNode).addClass('tr_{$educationalStage->id}');
        </script>
        HTML;

        $this->successMsg('تم انشاء مرحلة التعليمية');
    }

    // update eductaional stage name
    public function updateName(Request $request)
    {
        $educational_stage_id = $request->input('educational_stage_id');
        $educational_stage_name = $request->input('educational_stage_name');

        EducationalStage::where('id', $educational_stage_id)->update([
            'name' => $educational_stage_name,
            'slug' => Str::slug($educational_stage_name),
        ]);
    }

    // update eductaional stage description
    public function updateDescription(Request $request)
    {
        $educational_stage_id = $request->input('educational_stage_id');
        $educational_stage_description = $request->input('educational_stage_description');

        EducationalStage::where('id', $educational_stage_id)->update([
            'description' => $educational_stage_description,
        ]);
    }

    // delete eductaional stage
    public function delete(Request $request)
    {
        $educational_stage_id = $request->input('educational_stage_id');

        EducationalStage::where('id', $educational_stage_id)->delete();

        $this->successMsg('تم مسح االمرحلة التعليمية');
    }
}
