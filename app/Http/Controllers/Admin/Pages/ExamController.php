<?php

namespace App\Http\Controllers\Admin\Pages;

use App\Http\Controllers\Controller;
use App\Models\EducationalStages\EducationalClass;
use App\Models\EducationalStages\EducationalStage;
use App\Models\Exams\Exam;
use App\Models\Exams\ExamQuestion;
use App\Models\Subjects\Subject;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ExamController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin.auth:admin');
    }

    public function index()
    {
        return view('admin.pages.exam.index');
    }

    public function create()
    {
        $educationalStages = EducationalStage::get();
        $subjects = Subject::get();

        return view('admin.pages.exam.create')
        ->with('educationalStages', $educationalStages)
        ->with('subjects', $subjects);
    }

    public function show($slug)
    {
        $exam = Exam::where('slug', $slug)->first();

        $exam == null ? $this->redierctTo('admin/exam/all-exams') : true;

        $exam_json_file = public_path('uploads/exams/'.$exam->belongsToEducationalStage->slug.'/'.$exam->belongsToEducationalClass->slug.'/'.$exam->belongsToSubject->slug.'/'.$slug.'/exam.json');
        
        $exam_json_data = json_encode(json_decode(file_get_contents($exam_json_file), JSON_PRETTY_PRINT), true);

        return view('admin.pages.exam.show')
        ->with('exam', $exam)
        ->with('exam_json_data', $exam_json_data);
    }

    public function preview($slug)
    {
        $exam = Exam::where('slug', $slug)->first();

        $exam_json_file = public_path('uploads/exams/'.$exam->belongsToEducationalStage->slug.'/'.$exam->belongsToEducationalClass->slug.'/'.$exam->belongsToSubject->slug.'/'.$slug.'/exam.json');
        
        $exam_json_data = json_encode(json_decode(file_get_contents($exam_json_file), JSON_PRETTY_PRINT), true);

        return view('admin.pages.exam.preview')
        ->with('exam', $exam)
        ->with('exam_json_data', $exam_json_data);
    }

    // datatable to view all educational stages
    public function datatable()
    {
        $exam = Exam::get();

        return Datatables::of($exam)
        ->editColumn('educational_stage', function ($exam) {
            return $exam->belongsToEducationalStage->name;
        })
        ->editColumn('educational_class', function ($exam) {
            return $exam->belongsToEducationalClass->name;
        })
        ->editColumn('title', function ($exam) {
            return $exam->title;
        })
        ->editColumn('subject', function ($exam) {
            return $exam->belongsToSubject->name;
        })
        ->editColumn('isPublished', function ($exam) {
            return $exam->isPublished;
        })
        ->rawColumns(['name'])
        ->make(true);
    }

    public function displayEducationalClasses(Request $request)
    {
        $educational_stage_id = $request->input('educational_stage_id');

        $educationalStage = EducationalStage::where('id', $educational_stage_id)->first();
        
        return view('admin.pages.exam.display-classes')->with('educationalStage', $educationalStage);
    }

    public function createExams(Request $request)
    {
        $exam_json_data = $request->input('exam_json_data');
        $educational_stage_id = $request->input('educational_stage_id');
        $educational_class_id = $request->input('educational_class_id');
        $subject_id = $request->input('subject_id');
        $slug = md5(uniqid());

        $json = json_decode($exam_json_data, true);

        $educationalStage = EducationalStage::where('id', $educational_stage_id)->first();
        $educationalClass = EducationalClass::where('id', $educational_class_id)->first();
        $subject = Subject::where('id', $subject_id)->first();

        $exam_path = public_path('uploads/exams/'.$educationalStage->slug.'/'.$educationalClass->slug.'/'.$subject->slug.'/'.$slug);

        if(!file_exists($exam_path)){

            mkdir($exam_path, 0777, true);
        }

        $myfile = fopen(public_path('uploads/exams/'.$educationalStage->slug.'/'.$educationalClass->slug.'/'.$subject->slug.'/'.$slug.'/exam.json'), "w+") or die("Unable to open file!");
        fwrite($myfile, json_encode($json, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
        fclose($myfile);

        $exam = Exam::create([
            'title' => isset($json['title']) ? $json['title'] : null,
            'description' => isset($json['description']) ? $json['description'] : null,
            'slug' => $slug,
            'educational_stage_id' => $educational_stage_id,
            'educational_class_id' => $educational_class_id,
            'subject_id' => $subject_id,
        ]);

        $score = 0;

        for($i = 0; $i < count($json['pages']); $i++){

            for($j = 0; $j < count($json['pages'][$i]['elements']); $j++){

                $question = $json['pages'][$i]['elements'][$j]['title'];
                $score = $json['pages'][$i]['elements'][$j]['valueName'];
                
                ExamQuestion::create([
                    'exam_id' => $exam->id,
                    'question' => $question,
                    'score' => $score,
                ]);
            }
        }

        $this->successMsg('تم انشاء امتحان جديد');

        $this->redierctTo('admin/exam/'.$slug.'/show');
    }

    public function publish(Request $request)
    {
        Exam::where('id', $request->input('exam_id'))->update([
            'isPublished' => 1,
        ]);

        $this->successMsg('لقد تم نشر الامتحان');

        $this->reloadPage();
    }

    public function unpublish(Request $request)
    {
        Exam::where('id', $request->input('exam_id'))->update([
            'isPublished' => 0,
        ]);

        $this->successMsg('لقد تم اخفاء الامتحان');

        $this->reloadPage();
    }

    public function update(Request $request)
    {
        $exam_id = $request->input('exam_id');
        $exam_json_data = $request->input('exam_json_data');

        $json = json_decode($exam_json_data, true);
        
        // dd($json);

        $exam = Exam::where('id', $exam_id)->first();

        $exam_json_file = public_path('uploads/exams/'.$exam->belongsToEducationalStage->slug.'/'.$exam->belongsToEducationalClass->slug.'/'.$exam->belongsToSubject->slug.'/'.$exam->slug.'/exam.json');

        file_exists($exam_json_file) ? $this->removeFile($exam_json_file) : true;

        // recreate json file
        $exam_path = public_path('uploads/surveys/survey-js/'.$exam->slug);

        if(!file_exists($exam_path)){

            mkdir($exam_path, 0777, true);
        }

        $myfile = fopen(public_path('uploads/exams/'.$exam->belongsToEducationalStage->slug.'/'.$exam->belongsToEducationalClass->slug.'/'.$exam->belongsToSubject->slug.'/'.$exam->slug.'/exam.json'), "w+") or die("Unable to open file!");
        fwrite($myfile, json_encode($json, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
        fclose($myfile);

        // update survey in database
        $exam->update([
            'title' => isset($json['title']) ? $json['title'] : null,
            'description' => isset($json['description']) ? $json['description'] : null,
        ]);

        // get survey questions
        $examQuestions = ExamQuestion::where('exam_id', $exam_id)->get();

        // delete survey questions
        foreach($examQuestions as $examQuestion){

            $examQuestion->delete();
        }
        
        $score = 0;
        
        // recreate survey questions
        for($i = 0; $i < count($json['pages']); $i++){

            for($j = 0; $j < count($json['pages'][$i]['elements']); $j++){

                $question = $json['pages'][$i]['elements'][$j]['title'];
                $score = $json['pages'][$i]['elements'][$j]['placeHolder'];

                ExamQuestion::create([
                    'exam_id' => $exam_id,
                    'question' => $question,
                    'score' => $score,
                ]);
            }
        }

        $this->successMsg('تم تحديث الامتحان');

        $this->reloadPage();
    }

    public function delete(Request $request)
    {
        $exam = Exam::where('id', $request->input('exam_id'))->first();

        $exam_dir = public_path('uploads/exams/'.$exam->belongsToEducationalStage->slug.'/'.$exam->belongsToEducationalClass->slug.'/'.$exam->belongsToSubject->slug.'/'.$exam->slug);

        file_exists($exam_dir) ? $this->deleteDir($exam_dir) : true;

        $exam->delete();

        $this->successMsg('تم مسح الامتحان');

        $this->redierctTo('admin/exam/all-exams');
    }
}
