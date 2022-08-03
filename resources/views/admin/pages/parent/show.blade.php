@extends('admin.layouts.app', [
    'title' => 'ولي الأمر : '.$parent->name,
    'active' => 'parents',
    'scripts' => 'pages.parent.show',
    'breadcrumb' => [
        'title' => 'ولي الأمر : '.$parent->name,
        'map' => [
            'لوحة التحكم' => 'admin.home',
            'أولياء الأمور' => 'admin.parents',
            'ولي الأمر : '.$parent->name => 'active',
        ]
    ]
]);

@section('content')
<!-- Update Parent Data -->
<section class="content">
    <div class="row">
        <div class="col-lg-6 col-12">
            <!-- Update Parent Info -->
            <div class="box">
                <div class="box-header with-border">
                    <h4 class="box-title">بيانات ولي الأمر</h4>
                </div>
                <!-- /.box-header -->
                <form class="form" id="update-parent-info">
                    {{ csrf_field() }}
                    <input type="hidden" name="parent_id" value="{{ $parent->id }}">
                    <div class="box-body">
                        <div class="form-group">
                            <label>اسم ولي الأمر</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ti-user"></i></span>
                                </div>
                                <input type="text" class="form-control" name="parent_name" value="{{ $parent->name }}" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>البريد الالكتروتي</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ti-email"></i></span>
                                </div>
                                <input type="email" class="form-control" name="parent_email" value="{{ $parent->email }}" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>الجنس</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ti-eye"></i></span>
                                </div>
                                <select name="gender" class="form-control" id="gender">
                                    <option value="1" {{ $parent->gender == '1' ? 'selected' : null }}>ذكر</option>
                                    <option value="2" {{ $parent->gender == '2' ? 'selected' : null }}>انثي</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit" class="btn btn-rounded btn-primary btn-outline">
                            <i class="ti-save-alt"></i> تحديث البيانات
                        </button>

                        <button type="button" class="btn btn-rounded btn-danger btn-outline" data-parent-id="{{ $parent->id }}" id="delete-parent">
                            <i class="ti-trash"></i> مسح الحساب
                        </button>
                    </div>  
                </form>
            </div>
            <!-- /.Update Parent Info -->

            <!-- Update Parent Password -->
            <div class="box">
                <div class="box-header with-border">
                    <h4 class="box-title">تغيير كلمة السر</h4>
                </div>
                <!-- /.box-header -->
                <form class="form" id="update-parent-password">
                    {{ csrf_field() }}
                    <input type="hidden" name="parent_id" value="{{ $parent->id }}">
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
            <!-- /.Update Parent Password -->	
        </div>

        <!-- Update Parent Image -->
        <div class="col-lg-6 col-12">
            <div class="box">
                <div class="box-header with-border">
                    <h4 class="box-title">
                        صورة ولي الأمر 
                    </h4>
                </div>
                <!-- /.box-header -->
                <form class="form" id="update-parent-image">
                    {{ csrf_field() }}
                    <input type="hidden" name="parent_id" value="{{ $parent->id }}">
                    <div class="box-body">
                        <div class="form-group">
                        @if($parent->image == null)
                            @if($parent->gender == '1')
                            <img src="{{ asset('app-assets/images/avatars/male.png') }}" class="img-fluid" alt="{{ $parent->name }}">
                            @else
                            <img src="{{ asset('app-assets/images/avatars/female.png') }}" class="img-fluid" alt="{{ $parent->name }}">
                            @endif
                        @else
                            <img src="{{ asset('uploads/parents/'.$parent->slug.'/images/personal-image/'.$parent->image) }}" class="img-fluid" alt="{{ $parent->name }}">
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
                        @if($parent->image != null)
                        <button type="button" class="btn btn-rounded btn-danger btn-outline" id="remove-parent-image" data-parent-id="{{ $parent->id }}">
                            <i class="ti-trash"></i> ازاله الصورة
                        </button>
                        @endif
                    </div>  
                </form>
            </div>
            <!-- /.box -->			
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="box">
                <div class="box-header">						
                    <h4 class="box-title">الطلبة الذين ينتمون الي هذا ولي الأمر</h4>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table id="parents" class="table table-striped table-bordered display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>اسم الطالب</th>
                                    <th>البريد الالكتروني الخاص بطالب</th>
                                    <th>ينتمي الي مرحلة تعليمية</th>
                                    <th>ينتمي الي فصل</th>
                                    <th>تم الاتضمام بتاريخ</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($parent->students as $student)
                                <tr>
                                    <td>
                                        <a href="{{ route('admin.student.show', $student->belongsToStudent->slug) }}">{{ $student->belongsToStudent->name }}</a>
                                    </td>
                                    <td>{{ $student->belongsToStudent->email }}</td>
                                    <td>{{ $student->belongsToStudent->belongsToStudentClass->belongsToEducationalClass->name }}</td>
                                    <td>{{ $student->belongsToStudent->belongsToStudentClass->belongsToClassRoom->name }}</td>
                                    <td>{{ date('Y-m-d h:i a', strtotime($student->belongsToStudent->created_at)) }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--/ Update Parent Data -->

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