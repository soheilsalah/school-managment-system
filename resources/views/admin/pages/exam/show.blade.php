@extends('admin.layouts.app', [
    'title' => $exam->title,
    'active' => 'exams',
    'scripts' => 'pages.exam.show',
    'breadcrumb' => [
        'title' => $exam->title,
        'map' => [
            'لوحة التحكم' => 'admin.home',
            'جميع الامتحانات' => 'admin.exams',
            $exam->title => 'active'
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
                <h4 class="box-title float-left">{{ $exam->description }}</h4>  
                @if ($exam->isPublished == 1)
                <button class="btn btn-success btn-sm btn-round btn-outline float-right">
                    تم نشر الامتحان
                    <i class="fa fa-check"></i>
                </button>
                @else
                <button class="btn btn-danger btn-sm btn-round float-right" id="publish-exam" data-exam-id="{{ $exam->id }}">اضغط هنا لنشر الامتحان</button>
                @endif
            </div>
            <div class="box-body">
                <div class="row justify-content-center">
                    <div class="col-9">
                        <div class="form-group row">
                            <label for="topic" class="col-sm-3 col-form-label">اسم الامتحان</label>
                            <div class="col-sm-9">
                                <input class="form-control" type="text" value="{{ $exam->title }}" id="topic" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="topic" class="col-sm-3 col-form-label">ينتمي الي مرحلة تعليمية</label>
                            <div class="col-sm-9">
                                <input class="form-control" type="text" value="{{ $exam->belongsToEducationalStage->name }}" id="topic" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="topic" class="col-sm-3 col-form-label">ينتمي الي الصف التعليمي</label>
                            <div class="col-sm-9">
                                <input class="form-control" type="text" value="{{ $exam->belongsToEducationalClass->name }}" id="topic" readonly>
                            </div>
                        </div>
    
                        <div class="form-group row">
                            <label for="subject" class="col-sm-3 col-form-label">المادة</label>
                            <div class="col-sm-9">
                                <input class="form-control" type="text" value="{{ $exam->belongsToSubject->name }}" id="subject" readonly>
                            </div>
                        </div>
    
                        <div class="form-group row">
                            <label for="password" class="col-sm-3 col-form-label">عرض الامتحان كصفحة تجريبية</label>
                            <div class="col-sm-9">
                                <a href="{{ route('admin.exam.preview', $exam->slug) }}" class="btn btn-primary btn-sm" target="_blank">رابط الانضمام المحاضرة</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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