@extends('admin.layouts.app', [
    'title' => 'الطالب : '.$student->name,
    'active' => 'students',
    'scripts' => 'pages.student.show',
    'breadcrumb' => [
        'title' => 'الطالب : '.$student->name,
        'map' => [
            'لوحة التحكم' => 'admin.home',
            'الطلاب' => 'admin.students',
            'الطالب : '.$student->name => 'active',
        ]
    ]
]);

@section('content')
<!-- Update student Data -->
<section class="content">
    <div class="row">
        <div class="col-lg-6 col-12">
            <!-- Update student Info -->
            <div class="box">
                <div class="box-header with-border">
                    <h4 class="box-title">بيانات الطالب</h4>
                </div>
                <!-- /.box-header -->
                <form class="form" id="update-student-info">
                    {{ csrf_field() }}
                    <input type="hidden" name="student_id" value="{{ $student->id }}">
                    <div class="box-body">
                        <div class="form-group">
                            <label>اسم الطالب</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ti-user"></i></span>
                                </div>
                                <input type="text" class="form-control" name="student_name" value="{{ $student->name }}" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>البريد الالكتروتي</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ti-email"></i></span>
                                </div>
                                <input type="email" class="form-control" name="student_email" value="{{ $student->email }}" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>الجنس</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ti-eye"></i></span>
                                </div>
                                <select name="gender" class="form-control" id="gender">
                                    <option value="1" {{ $student->gender == '1' ? 'selected' : null }}>ذكر</option>
                                    <option value="2" {{ $student->gender == '2' ? 'selected' : null }}>انثي</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit" class="btn btn-rounded btn-primary btn-outline">
                            <i class="ti-save-alt"></i> تحديث البيانات
                        </button>

                        <button type="button" class="btn btn-rounded btn-danger btn-outline" data-student-id="{{ $student->id }}" id="delete-student">
                            <i class="ti-trash"></i> مسح الحساب
                        </button>
                    </div>  
                </form>
            </div>
            <!-- /.Update student Info -->

            <!-- Update student Parent -->
            <div class="box">
                <div class="box-header with-border">
                    <h4 class="box-title">تغيير ولي أمر هذا الطالب</h4>
                </div>
                <!-- /.box-header -->
                <form class="form" id="update-student-parent">
                    {{ csrf_field() }}
                    <input type="hidden" name="student_id" value="{{ $student->id }}">
                    <div class="box-body">
                        <div class="form-group row">
                            <div class="col-md-8 col-12">
                                <label for="parents">اختر ولي الأمر</label>
                                <select class="form-control select2" name="parent_id" id="parents" style="width: 100%;">
                                @foreach($parents as $parent)
                                    <option value="{{ $parent->id }}" {{ $parent->id == $student->parentStudent->belongsToParent->id ? 'selected' : null }}>{{ $parent->name }}</option>
                                @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 col-12 mt-4">
                                <button type="submit" class="btn btn-rounded btn-success btn-outline btn-sm">
                                    <i class="ti-save-alt"></i> تغيير ولي الأمر
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </form>
            </div>
            <!-- /.Update student Parent -->	

            <!-- Update student educational stage -->
            <div class="box">
                <div class="box-header with-border">
                    <h4 class="box-title">تغيير الصف التعليمي هذا الطالب</h4>
                </div>
                <!-- /.box-header -->
                <form class="form" id="update-student-educational-class">
                    {{ csrf_field() }}
                    <input type="hidden" name="student_id" value="{{ $student->id }}">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="educational_class">اختر الصف التعليمي</label>
                            <select class="form-control select2" name="educational_class_id" id="educational_class" style="width: 100%;">
                            @foreach($educationalClasses as $educationalClass)
                                <option value="{{ $educationalClass->id }}" {{ $student->belongsToStudentClass->educational_class_id == $educationalClass->id ? 'selected' : null }}>{{ $educationalClass->name }}</option>
                            @endforeach
                            </select>
                        </div>

                        <div id="display_classrooms_res"></div>

                        <button type="submit" class="btn btn-rounded btn-success btn-outline btn-sm">
                            <i class="ti-save-alt"></i> تغيير الصف التعليمي
                        </button>
                    </div>
                    <!-- /.box-body -->
                </form>
            </div>
            <!-- /.Update student Parent -->	

            <!-- Update student Password -->
            <div class="box">
                <div class="box-header with-border">
                    <h4 class="box-title">تغيير كلمة السر</h4>
                </div>
                <!-- /.box-header -->
                <form class="form" id="update-student-password">
                    {{ csrf_field() }}
                    <input type="hidden" name="student_id" value="{{ $student->id }}">
                    <div class="box-body">
                        <div class="form-group">
                            <label>كلمة السر الحالية</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ti-lock"></i></span>
                                </div>
                                <input type="password" name="current_password" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>كلمة السر الجديدة</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ti-lock"></i></span>
                                </div>
                                <input type="password" name="new_password" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>تأكيد كلمة السر الجديدة</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ti-lock"></i></span>
                                </div>
                                <input type="password" name="confirm_password" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit" class="btn btn-rounded btn-primary btn-outline">
                            <i class="ti-save-alt"></i> تحديث كلمة السر
                        </button>
                    </div>  
                </form>
            </div>
            <!-- /.Update student Password -->	
        </div>

        <!-- Update student Image -->
        <div class="col-lg-6 col-12">
            <div class="box">
                <div class="box-header with-border">
                    <h4 class="box-title">
                        صورة الطالب 
                    </h4>
                </div>
                <!-- /.box-header -->
                <form class="form" id="update-student-image">
                    {{ csrf_field() }}
                    <input type="hidden" name="student_id" value="{{ $student->id }}">
                    <div class="box-body">
                        <div class="form-group">
                        @if($student->image == null)
                            @if($student->gender == '1')
                            <img src="{{ asset('images/avatars/male.png') }}" class="img-fluid" alt="{{ $student->name }}">
                            @else
                            <img src="{{ asset('images/avatars/female.png') }}" class="img-fluid" alt="{{ $student->name }}">
                            @endif
                        @else
                            <img src="{{ asset('uploads/students/'.$student->slug.'/images/personal-image/'.$student->image) }}" class="img-fluid" alt="{{ $student->name }}">
                        @endif
                        </div>
                        <div class="form-group">
                            <label>اختيار صورة جديدة</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ti-user"></i></span>
                                </div>
                                <input type="file" class="form-control" name="image">
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit" class="btn btn-rounded btn-primary btn-outline">
                            <i class="ti-save-alt"></i> تغيير
                        </button>
                        @if($student->image != null)
                        <button type="button" class="btn btn-rounded btn-danger btn-outline" id="remove-student-image" data-student-id="{{ $student->id }}">
                            <i class="ti-trash"></i> ازاله الصورة
                        </button>
                        @endif
                    </div>  
                </form>
            </div>
            <!-- /.box -->			
        </div>
    </div>
</section>
<!--/ Update student Data -->

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