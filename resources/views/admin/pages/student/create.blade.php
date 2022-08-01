@extends('admin.layouts.app', [
    'title' => 'انشاء طالب جديد',
    'active' => 'student.create',
    'scripts' => 'pages.student.create',
    'breadcrumb' => [
        'title' => 'انشاء طالب جديد',
        'map' => [
            'لوحة التحكم' => 'admin.home',
            'أولياء الأمور' => 'admin.students',
            'انشاء طالب جديد' => 'active',
        ]
    ]
]);

@section('content')
<!-- Create New Student -->
<section class="content">
    <div class="row justify-content-center">
        <div class="col-8">
            <div class="box">
                <div class="box-header with-border">
                    <h4 class="box-title">استمارة انشاء طالب جديد</h4>
                </div>
                <!-- /.box-header -->
                <form class="form" id="create-student">
                    {{ csrf_field() }}
                    <div class="box-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group row">
                                    <label for="student_name" class="col-sm-3 col-form-label">اسم طالب جديد</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="text" name="student_name" id="student_name" required>
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label for="student_email" class="col-sm-3 col-form-label">البريد الالكتروني</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="email" name="student_email" id="student_email" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="parents" class="col-sm-3 col-form-label">اختر ولي أمر هذا الطالب</label>
                                    <div class="col-sm-9">
                                        <select class="form-control select2" name="parent_id" id="parents" style="width: 100%;">
                                        @foreach($parents as $parent)
                                            <option value="{{ $parent->id }}">{{ $parent->name }}</option>
                                        @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="educational_classes" class="col-sm-3 col-form-label">اختر الصف التعليمي</label>
                                    <div class="col-sm-9">
                                        <select class="form-control select2" name="educational_class_id" id="educational_classes" style="width: 100%;">
                                        @foreach($educationalClasses as $educationalClass)
                                            <option value="{{ $educationalClass->id }}">{{ $educationalClass->name }}</option>
                                        @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="gender" class="col-sm-3 col-form-label">الجنس</label>
                                    <div class="col-sm-9">
                                        <select name="gender" class="form-control" id="gender">
                                            <option value="1">ذكر</option>
                                            <option value="2">انثي</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password" class="col-sm-3 col-form-label">كلمة السر</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="password" name="password" id="password" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="confirm_password" class="col-sm-3 col-form-label">تأكيد كلمة السر</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="password" name="confirm_password" id="confirm_password" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="image" class="col-sm-3 col-form-label">صورة طالب جديد (اختياري)</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="file" name="image" id="image">
                                    </div>
                                </div>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit" class="btn btn-rounded btn-primary btn-outline">
                            <i class="ti-save-alt"></i> انشاء حساب
                        </button>
                    </div> 
                </form>
            </div>
            <!-- /.box -->
        </div>
    </div>
</section>
<!--/ Create New Student -->

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