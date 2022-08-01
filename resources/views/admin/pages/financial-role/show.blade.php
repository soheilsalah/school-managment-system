@extends('admin.layouts.app', [
    'title' => 'المسؤول المالي : '.$financialRole->name,
    'active' => 'financial-roles',
    'scripts' => 'pages.financial-role.show',
    'breadcrumb' => [
        'title' => 'المسؤول المالي : '.$financialRole->name,
        'map' => [
            'لوحة التحكم' => 'admin.home',
            'المسؤول الماليين' => 'admin.financial-roles',
            'المسؤول المالي : '.$financialRole->name => 'active',
        ]
    ]
]);

@section('content')
<!-- Update Financial Role Data -->
<section class="content">
    <div class="row">
        <div class="col-lg-6 col-12">
            <!-- Update Financial Role Info -->
            <div class="box">
                <div class="box-header with-border">
                    <h4 class="box-title">بيانات المسؤول المالي</h4>
                </div>
                <!-- /.box-header -->
                <form class="form" id="update-financial-role-info">
                    {{ csrf_field() }}
                    <input type="hidden" name="financial_role_id" value="{{ $financialRole->id }}">
                    <div class="box-body">
                        <div class="form-group">
                            <label>اسم المسؤول المالي</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ti-user"></i></span>
                                </div>
                                <input type="text" class="form-control" name="financial_role_name" value="{{ $financialRole->name }}" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>البريد الالكتروتي</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ti-email"></i></span>
                                </div>
                                <input type="email" class="form-control" name="financial_role_email" value="{{ $financialRole->email }}" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>الجنس</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ti-eye"></i></span>
                                </div>
                                <select name="gender" class="form-control" id="gender">
                                    <option value="1" {{ $financialRole->gender == '1' ? 'selected' : null }}>ذكر</option>
                                    <option value="2" {{ $financialRole->gender == '2' ? 'selected' : null }}>انثي</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit" class="btn btn-rounded btn-primary btn-outline">
                            <i class="ti-save-alt"></i> تحديث البيانات
                        </button>

                        <button type="button" class="btn btn-rounded btn-danger btn-outline" data-financial-role-id="{{ $financialRole->id }}" id="delete-financial-role">
                            <i class="ti-trash"></i> مسح الحساب
                        </button>
                    </div>  
                </form>
            </div>
            <!-- /.Update Financial Role Info -->

            <!-- Update Financial Role Password -->
            <div class="box">
                <div class="box-header with-border">
                    <h4 class="box-title">تغيير كلمة السر</h4>
                </div>
                <!-- /.box-header -->
                <form class="form" id="update-financial-role-password">
                    {{ csrf_field() }}
                    <input type="hidden" name="financial_role_id" value="{{ $financialRole->id }}">
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
            <!-- /.Update Financial Role Password -->	
        </div>

        <!-- Update Financial Role Image -->
        <div class="col-lg-6 col-12">
            <div class="box">
                <div class="box-header with-border">
                    <h4 class="box-title">
                        صورة {{ $financialRole->gender == '1' ? 'المسؤول المالي' : 'المسؤولة المالية'}}
                    </h4>
                </div>
                <!-- /.box-header -->
                <form class="form" id="update-financial-role-image">
                    {{ csrf_field() }}
                    <input type="hidden" name="financial_role_id" value="{{ $financialRole->id }}">
                    <div class="box-body">
                        <div class="form-group">
                        @if($financialRole->image == null)
                            @if($financialRole->gender == '1')
                            <img src="{{ asset('images/avatars/male.png') }}" class="img-fluid" alt="{{ $financialRole->name }}">
                            @else
                            <img src="{{ asset('images/avatars/female.png') }}" class="img-fluid" alt="{{ $financialRole->name }}">
                            @endif
                        @else
                            <img src="{{ asset('uploads/financial-roles/'.$financialRole->slug.'/images/personal-image/'.$financialRole->image) }}" class="img-fluid" alt="{{ $financialRole->name }}">
                        @endif
                        </div>
                        <div class="form-group">
                            <label>اختيار صورة جديدة</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ti-user"></i></span>
                                </div>
                                <input type="file" class="form-control" name="image" id="image">
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit" class="btn btn-rounded btn-primary btn-outline">
                            <i class="ti-save-alt"></i> تغيير
                        </button>
                        @if($financialRole->image != null)
                        <button type="button" class="btn btn-rounded btn-danger btn-outline" id="remove-financial-role-image" data-financial-role-id="{{ $financialRole->id }}">
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
<!--/ Update Financial Role Data -->

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