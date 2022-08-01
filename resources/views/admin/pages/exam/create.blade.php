@extends('admin.layouts.app', [
    'title' => 'انشاء امتحان جديد',
    'active' => 'exams',
    'assets' => 'pages.exam.create',
    'breadcrumb' => [
        'title' => 'انشاء امتحان جديد',
        'map' => [
            'لوحة التحكم' => 'admin.home',
            'انشاء امتحان جديد' => 'active'
        ]
    ]
]);

@section('content')
<!-- Create new Exam Form -->
<section class="content">
    <div class="row">
      <div class="col-12">
        <div class="box">
            <div class="box-header">
                <h4 class="box-title">انشاء امتحان جديدة</h4>  
            </div>
            <form id="create-exam">
                <div class="box-body">
                    {{ csrf_field() }}
    
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="educational_stage">المرحلة التعليمية</label>
                            <select class="form-control select2" name="educational_stage_id" id="educational_stage" style="width: 100%;">
                            @foreach ($educationalStages as $educationalStage)
                                <option value="{{ $educationalStage->id }}">{{ $educationalStage->name }}</option>
                            @endforeach
                            </select>
                        </div>
                        
                        <div class="form-group col-6">
                            <div id="educational-class-res"></div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-6">
                            <label for="subject">اختر المادة</label>
                            <select class="form-control select2" name="subject_id" id="subject" style="width: 100%;">
                            @foreach ($subjects as $subject)
                                <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                            @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div id="surveyContainer">
                    <div id="creatorElement" style="height: 100vh;"></div>
                </div>
                
                <textarea name="exam_json_data" class="form-control" id="" dir="ltr" cols="30" rows="50"></textarea>

                <div class="box-footer">
                    <button type="submit" class="btn btn-rounded btn-primary btn-outline">
                    <i class="ti-save-alt"></i> انشاء الامتحان
                    </button>
                </div> 
            </form>
        </div>
      </div>
    </div>
</section>
<!--/ Create new Exam Form -->

<!-- Loading Modal -->
<div class="modal" id="loading" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content text-right">
            <div class="modal-body">
                <div class="progress text-right">
                    <div id="progressbar" class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Result Modal -->
<div class="modal" id="resModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content text-right">
            <div class="modal-body text-center">
                <div id="res"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="onCloseModal"> اغلاق النافذة </button>
            </div>
        </div>
    </div>
</div>

<!-- Error Modal -->
<div class="modal" id="error" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content text-right">
            <div class="modal-body text-center">
				<span class="fa fa-times text-danger" style="font-size: 100px;"></span>
				<h1>حدث خطاء</h1>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="onCloseModal"> اغلاق النافذة </button>
            </div>
        </div>
    </div>
</div>
@endsection