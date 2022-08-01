@extends('instructor.layouts.app', [
    'title' => $scheduleSession->belongsToSubject->name,
    'active' => 'schedule-sessions',
    'breadcrumb' => [
        'title' => $scheduleSession->belongsToSubject->name,
        'map' => [
            'لوحة التحكم' => 'admin.home',
            'جداول الحصص' => 'admin.schedule-sessions',
            $scheduleSession->belongsToSubject->name => 'active',
        ]
    ]
]);

@section('content')
<!-- Main content -->
<section class="content">
    <div class="box">
        <div class="box-header with-border">
            <h4 class="box-title">{{ $scheduleSession->belongsToSubject->name }} بواسطة {{ $scheduleSession->belongsToInstructor->name }}</h4>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="row justify-content-center">
                <div class="col-8">
                    <div class="form-group row">
                        <label for="topic" class="col-sm-3 col-form-label">اسم الحصة</label>
                        <div class="col-sm-9">
                            <input class="form-control" type="text" value="{{ $scheduleSession->topic }}" id="topic" readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="instructor" class="col-sm-3 col-form-label">اسم المحاضر</label>
                        <div class="col-sm-9">
                            <input class="form-control" type="text" value="{{ $scheduleSession->belongsToInstructor->name }}" id="instructor" readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="subject" class="col-sm-3 col-form-label">المادة</label>
                        <div class="col-sm-9">
                            <input class="form-control" type="text" value="{{ $scheduleSession->belongsToSubject->name }}" id="subject" readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="duration" class="col-sm-3 col-form-label">مواعيد المحاضرة</label>
                        <div class="col-sm-9">
                            <input class="form-control" type="text" value="{{ date('Y-m-d h:i a', strtotime($scheduleSession->start_at)) }}" id="duration" readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="meeting_id" class="col-sm-3 col-form-label">رقم الاجتماع</label>
                        <div class="col-sm-9">
                            <input class="form-control" type="text" value="{{ $scheduleSession->meeting_id }}" id="meeting_id" readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password" class="col-sm-3 col-form-label">الرقم السري</label>
                        <div class="col-sm-9">
                            <input class="form-control" type="text" value="{{ $scheduleSession->password }}" id="password" readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password" class="col-sm-3 col-form-label">الانضمام المحاضرة</label>
                        <div class="col-sm-9">
                            <a href="{{ $scheduleSession->join_url }}" class="btn btn-primary btn-sm" target="_blank">رابط الانضمام المحاضرة</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

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