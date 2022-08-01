@extends('admin.layouts.app', [
    'title' => $lab->name,
    'active' => 'labs',
    'scripts' => 'pages.lab.show',
    'breadcrumb' => [
        'title' => $lab->name,
        'map' => [
            'لوحة التحكم' => 'admin.home',
            'المعامل' => 'admin.labs',
            $lab->name => 'active',
        ]
    ]
]);

@section('content')
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-8">
            <div class="box">
                <form class="form" id="update-lab-info">
                    {{ csrf_field() }}
                    <input type="hidden" name="lab_id" value="{{ $lab->id }}">
                    <div class="box-body">
                        <h4 class="box-title text-danger"><i class="fa fa-question-circle-o mr-15"></i> بيانات المعمل</h4>
    
                        <div class="form-group">
                            <label for="lab_name">عنوان المعمل</label>
                            <input type="text" class="form-control" name="lab_name" id="lab_name" placeholder="مثال : الكثافة" value="{{ $lab->name }}" required>
                        </div>

                        <div class="form-group">
                            <label for="educational_stage">اختر مرحلة تعليمية للمعمل</label>
                            <select name="educational_stage_id" class="form-control" id="educational_stage">
                            @foreach($educationalStages as $educationalStage)
                                <option value="{{ $educationalStage->id }}" {{ $educationalStage->id == $lab->educational_stage_id ? 'selected' : null }}>{{ $educationalStage->name }}</option>
                            @endforeach
                            </select>
                        </div>

                        <div id="edcucation-classes-res"></div>

                        <div class="form-group">
                            <label for="subject">اختر المادة</label>
                            <select name="subject_id" class="form-control" id="subject">
                            @foreach($subjects as $subject)
                                <option value="{{ $subject->id }}" {{ $lab->subject_id == $subject->id ? 'selected' : null }}>{{ $subject->name }}</option>
                            @endforeach
                            </select>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit" class="btn btn-rounded btn-info btn-outline">
                            <i class="ti-save-alt"></i> تحديث بيانات المعمل
                        </button>

                        <button type="button" id="delete-lab" class="btn btn-rounded btn-danger btn-outline">
                            <i class="fa fa-trash"></i> مسح المعمل
                        </button>
                    </div>
                </form>
            </div>

            <div class="box">
                <form class="form" id="update-lab-link">
                    {{ csrf_field() }}
                    <input type="hidden" name="lab_id" value="{{ $lab->id }}">
                    <div class="box-body">
                        <h4 class="box-title text-danger"><i class="fa fa-flask mr-15"></i> المعمل</h4>

                        <div class="form-group">
                            <label for="lab_url">رابط المعمل</label>
                            <input type="url" class="form-control" name="lab_url" id="lab_url" dir="ltr" value="{{ $lab->link }}" required>
                        </div>

                        <div class="form-group">
                            <label for="lab_url">عرض المعمل</label>
                            <div class="embed-responsive embed-responsive-16by9">
                                <iframe class="embed-responsive-item" src="{{ $lab->link }}" allowfullscreen></iframe>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit" class="btn btn-rounded btn-success btn-outline">
                            <i class="ti-save-alt"></i> تحديث المعمل
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-4">
            <div class="box">
                <form class="form" id="update-lab-thumbnail">
                    {{ csrf_field() }}
                    <input type="hidden" name="lab_id" value="{{ $lab->id }}">
                    <div class="box-body">
                        <h4 class="box-title text-danger"><i class="fa fa-image mr-15"></i> صورة المعمل</h4>
                        
                        <div class="form-group">
                            <label for="thumbnail">تحديث صورة المعمل</label>
                            <div class="text-center">
                            @if($lab->thumbnail != null)
                                <img src="{{ asset('uploads/labs/'.$lab->slug.'/thumbnail/'.$lab->thumbnail) }}" alt="">
                            @else
                                <div class="jumbotron">
                                    <h5>لا توجد صورة للمعمل</h5>
                                </div>
                            @endif
                            </div>
                            <input type="file" class="form-control" name="thumbnail" id="thumbnail"  required>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit" class="btn btn-rounded btn-warning btn-outline btn-sm">
                            <i class="ti-save-alt"></i> تحديث الصورة
                        </button>

                        @if($lab->thumbnail != null)
                        <button type="button" id="delete-lab-thumbnail" class="btn btn-rounded btn-danger btn-outline btn-sm">
                            <i class="fa fa-trash"></i> مسح الصورة
                        </button>
                        @endif
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