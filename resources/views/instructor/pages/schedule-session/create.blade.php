@extends('instructor.layouts.app', [
    'title' => 'انشاء حصة جديدة',
    'active' => 'create-session',
    'scripts' => 'pages.schedule-session.create',
    'breadcrumb' => [
        'title' => 'انشاء حصة جديدة',
        'map' => [
            'لوحة التحكم' => 'instructor.home',
            'انشاء حصة جديدة' => 'active'
        ]
    ]
]);

@section('content')
<section class="content">
    <div class="row">
    @if($instructor->can_publish_session == 0)
        <div class="col-12">
            <div class="jumbotron text-center">
                <h3>ليس مسموح لك بانشاء حصص</h3>
            </div>
        </div>
    @else
        <div class="col-12">
            <div class="box">
                <div class="box-header">
                    <h4 class="box-title">انشاء حصة جديدة</h4>  
                </div>
                <form id="create-session">
                    <div class="box-body">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="form-group col-6">
                                <label for="topic">اسم الحصة</label>
                                <input class="form-control" type="text" name="topic" required>
                            </div>
                        
                            <div class="form-group col-6">
                                <label for="educational_stage">الصف التعليمي</label>
                                <select class="form-control select2" name="educational_class_id" id="educational_class_id" style="width: 100%;">
                                @foreach ($InstructorClasses as $InstructorClass)
                                    <option value="{{ $InstructorClass->educational_class_id }}">{{ $InstructorClass->belongsToEducationalClass->name }}</option>
                                @endforeach
                                </select>
                            </div>
                        </div>
        
                        <div class="row">
                            <div class="form-group col-6">
                                <label for="price">سعر الحصة</label>
                                <input class="form-control" id="price" type="number" name="price" min="1" pattern="[0-9]+" required>
                            </div>

                            <div class="form-group col-6">
                                <label for="subject">اختر المادة</label>
                                <select class="form-control select2" name="subject_id" id="subject" style="width: 100%;">
                                @foreach ($instructorSubjects as $instructorSubject)
                                    <option value="{{ $instructorSubject->belongsToSubject->id }}">{{ $instructorSubject->belongsToSubject->name }}</option>
                                @endforeach
                                </select>
                            </div>
                        </div>


                        <div class="row">
                            <div class="form-group col-6">
                                <label for="homework">
                                    ارفاق واجب مدرسي
                                    <small class="font-weight-bold text-danger">علي صيغة word</small>
                                </label>
                                <input type="file" class="form-control" name="homework" id="homework">
                            </div>

                            <div class="bootstrap-timepicker col-6">
                                <div class="form-group">
                                    <label for="start_at">مواعيد بدء الحصة</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control timepicker" name="start_at" value="{{ date('h:i a') }}" required>
                
                                        <div class="input-group-addon">
                                        <i class="fa fa-clock-o"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-6">
                                <label for="duration">مدة الحصة</label>
                                <input class="form-control" id="duration" type="number" name="duration" min="1" value="45" pattern="[0-9]+" required>
                            </div>
                        </div>

                        <hr>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="is_recurrsive" id="is_recurrsive">
                            <label class="form-check-label" for="is_recurrsive">
                                هل الحصة مكررة
                            </label>
                        </div>

                        <hr>
                        
                        <div id="is_recurrsive_res"></div>
                    
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-rounded btn-primary btn-outline">
                        <i class="ti-save-alt"></i> انشاء الحصة
                        </button>
                    </div> 
                </form>
            </div>
        </div>
    @endif
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