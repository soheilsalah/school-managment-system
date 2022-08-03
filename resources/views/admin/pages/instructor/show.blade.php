@extends('admin.layouts.app', [
    'title' => 'المدرس : '.$instructor->name,
    'active' => 'instructors',
    'scripts' => 'pages.instructor.show',
    'breadcrumb' => [
        'title' => 'المدرس : '.$instructor->name,
        'map' => [
            'لوحة التحكم' => 'admin.home',
            'المدرسين' => 'admin.instructors',
            'المدرس : '.$instructor->name => 'active',
        ]
    ]
]);

@section('content')
<!-- Update Instructor Data -->
<section class="content">
    <div class="row">
        <div class="col-lg-6 col-12">
            <!-- Update Instructor Info -->
            <div class="box">
                <div class="box-header with-border">
                    <h4 class="box-title">بيانات المدرس</h4>
                </div>
                <!-- /.box-header -->
                <form class="form" id="update-instructor-info">
                    {{ csrf_field() }}
                    <input type="hidden" name="instructor_id" value="{{ $instructor->id }}">
                    <div class="box-body">
                        <div class="form-group">
                            <label>اسم المدرس</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ti-user"></i></span>
                                </div>
                                <input type="text" class="form-control" name="instructor_name" value="{{ $instructor->name }}" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>البريد الالكتروتي</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ti-email"></i></span>
                                </div>
                                <input type="email" class="form-control" name="instructor_email" value="{{ $instructor->email }}" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>الجنس</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ti-eye"></i></span>
                                </div>
                                <select name="gender" class="form-control" id="gender">
                                    <option value="1" {{ $instructor->gender == '1' ? 'selected' : null }}>ذكر</option>
                                    <option value="2" {{ $instructor->gender == '2' ? 'selected' : null }}>انثي</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="can_publish_session" id="canInstructorPublishSession" {{ $instructor->can_publish_session == 1 ? 'checked' : null }}>
                            <label class="form-check-label" for="canInstructorPublishSession">
                              مسموح بانشاء حصة
                            </label>
                        </div>

                        <div id="can-publish-session-res"></div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit" class="btn btn-rounded btn-primary btn-outline">
                            <i class="ti-save-alt"></i> تحديث البيانات
                        </button>

                        <button type="button" class="btn btn-rounded btn-danger btn-outline" data-instructor-id="{{ $instructor->id }}" id="delete-instructor">
                            <i class="ti-trash"></i> مسح الحساب
                        </button>
                    </div>  
                </form>
            </div>
            <!-- /.Update Instructor Info -->

            <!-- Update Instructor Password -->
            <div class="box">
                <div class="box-header with-border">
                    <h4 class="box-title">تغيير كلمة السر</h4>
                </div>
                <!-- /.box-header -->
                <form class="form" id="update-instructor-password">
                    {{ csrf_field() }}
                    <input type="hidden" name="instructor_id" value="{{ $instructor->id }}">
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
            <!-- /.Update Instructor Password -->	

            <!-- Change Instructor Permision Create Book -->
            <div class="box">
                <div class="box-header with-border">
                    @php
                        $his_her = $instructor->gender == '1' ? 'لدية' : 'لديها';
                    @endphp
                    <h4 class="box-title">هل {{ $his_her }} صلاحية لانشاء كتب</h4>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input permission_to_create_book" type="radio" name="permission_to_create_book" id="yes_permission_to_create_book" value="1" {{ $instructor->permission_to_create_book == 1 ? 'checked' : null }} data-instructor-id="{{ $instructor->id }}">
                        <label class="form-check-label" for="yes_permission_to_create_book">نعم</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input permission_to_create_book" type="radio" name="permission_to_create_book" id="no_permission_to_create_book" value="0" {{ $instructor->permission_to_create_book == 0 ? 'checked' : null }} data-instructor-id="{{ $instructor->id }}">
                        <label class="form-check-label" for="no_permission_to_create_book">لا</label>
                    </div>
                </div>
            </div>
            <!-- /.Change Instructor Permision Create Book -->	
        </div>

        <!-- Update Instructor Image -->
        <div class="col-lg-6 col-12">
            <div class="box">
                <div class="box-header with-border">
                    <h4 class="box-title">
                        صورة {{ $instructor->gender == '1' ? 'المدرس' : 'المدرسة'}}
                    </h4>
                </div>
                <!-- /.box-header -->
                <form class="form" id="update-instructor-image">
                    {{ csrf_field() }}
                    <input type="hidden" name="instructor_id" value="{{ $instructor->id }}">
                    <div class="box-body">
                        <div class="form-group">
                        @if($instructor->image == null)
                            @if($instructor->gender == '1')
                            <img src="{{ asset('app-assets/images/avatars/male.png') }}" class="img-fluid" alt="{{ $instructor->name }}">
                            @else
                            <img src="{{ asset('app-assets/images/avatars/female.png') }}" class="img-fluid" alt="{{ $instructor->name }}">
                            @endif
                        @else
                            <img src="{{ asset('uploads/instructors/'.$instructor->slug.'/images/personal-image/'.$instructor->image) }}" class="img-fluid" alt="{{ $instructor->name }}">
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
                        @if($instructor->image != null)
                        <button type="button" class="btn btn-rounded btn-danger btn-outline" id="remove-instructor-image" data-instructor-id="{{ $instructor->id }}">
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
<!--/ Update Instructor Data -->

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