@extends('admin.layouts.app', [
    'title' => 'انشاء معمل جديد',
    'active' => 'lab.create',
    'scripts' => 'pages.lab.create',
    'breadcrumb' => [
        'title' => 'انشاء معمل جديد',
        'map' => [
            'لوحة التحكم' => 'admin.home',
            'المعامل' => 'admin.labs',
            'انشاء معمل جديد' => 'active',
        ]
    ]
]);

@section('content')
<!-- Main content -->
<section class="content">
    <div class="row justify-content-center">
        <div class="col-8">
            <div class="box">
                <div class="box-header with-border">
                    <h4 class="box-title">انشاء معمل جديد</h4>
                </div>
                <form class="form" id="create-lab">
                    {{ csrf_field() }}
                    <div class="box-body">
                        <h4 class="box-title text-danger"><i class="fa fa-flask mr-15"></i> بيانات المعمل</h4>
    
                        <div class="form-group">
                            <label for="lab_name">عنوان المعمل</label>
                            <input type="text" class="form-control" name="lab_name" id="lab_name" placeholder="مثال : الكثافة" required>
                        </div>

                        <div class="form-group">
                            <label for="lab_url">رابط المعمل</label>
                            <input type="url" class="form-control" name="lab_url" id="lab_url" dir="ltr" required>
                        </div>

                        <div class="form-group">
                            <label for="educational_stage">اختر مرحلة تعليمية للمعمل</label>
                            <select name="educational_stage_id" class="form-control" id="educational_stage">
                            @foreach($educationalStages as $educationalStage)
                                <option value="{{ $educationalStage->id }}">{{ $educationalStage->name }}</option>
                            @endforeach
                            </select>
                        </div>

                        <div id="edcucation-classes-res"></div>

                        <div class="form-group">
                            <label for="subject">اختر المادة</label>
                            <select name="subject_id" class="form-control" id="subject">
                            @foreach($subjects as $subject)
                                <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                            @endforeach
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="thumbnail">
                                صورة المعمل
                                <small class="font-weight-bold text-danger">( اختياري )</small>
                            </label>
                            <input type="file" class="form-control" name="thumbnail" id="thumbnail">
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit" class="btn btn-rounded btn-primary btn-outline">
                            <i class="ti-save-alt"></i> انشاء المعمل
                        </button>
                    </div>
                </form>
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