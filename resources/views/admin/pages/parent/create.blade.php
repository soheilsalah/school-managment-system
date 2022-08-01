@extends('admin.layouts.app', [
    'title' => 'انشاء ولي الأمر',
    'active' => 'parent.create',
    'scripts' => 'pages.parent.create',
    'breadcrumb' => [
        'title' => 'انشاء ولي الأمر',
        'map' => [
            'لوحة التحكم' => 'admin.home',
            'أولياء الأمور' => 'admin.parents',
            'انشاء ولي الأمر' => 'active',
        ]
    ]
]);

@section('content')
<!-- Create New Parent -->
<section class="content">
    <div class="row justify-content-center">
        <div class="col-8">
            <div class="box">
                <div class="box-header with-border">
                    <h4 class="box-title">استمارة انشاء ولي الأمر</h4>
                </div>
                <!-- /.box-header -->
                <form class="form" id="create-parent">
                    {{ csrf_field() }}
                    <div class="box-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group row">
                                    <label for="parent_name" class="col-sm-3 col-form-label">اسم ولي الأمر</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="text" name="parent_name" id="parent_name" required>
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label for="parent_email" class="col-sm-3 col-form-label">البريد الالكتروني</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="email" name="parent_email" id="parent_email" required>
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
                                    <label for="image" class="col-sm-3 col-form-label">صورة ولي الأمر (اختياري)</label>
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
<!--/ Create New Parent -->

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