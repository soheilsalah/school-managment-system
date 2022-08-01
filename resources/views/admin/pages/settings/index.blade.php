@extends('admin.layouts.app', [
    'title' => 'الاعدادات العامة',
    'scripts' => 'pages.settings.index',
    'breadcrumb' => [
        'title' => 'الاعدادات العامة',
        'map' => [
            'لوحة التحكم' => 'admin.home',
            'الاعدادات العامة' => 'active'
        ]
    ]
]);

@section('content')
<section class="content">
    <div class="row">			  
        <div class="col-12">
              <div class="box">
                <div class="box-header with-border">
                    <h4 class="box-title">تحديث الاسم و البريد الالكتروني</h4>
                </div>
                <!-- /.box-header -->
                <form class="form" id="update-info">
                    {{ csrf_field() }}
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                  <label for="username">اسم الحساب الخاص بك</label>
                                  <input type="text" name="username" id="username" class="form-control" value="{{ Auth::guard('admin')->user()->name }}" required>
                                </div>
                            </div>

                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                  <label for="email">البريد الالكتروني الخاص بالحساب</label>
                                  <input type="email" name="email" id="email" class="form-control" value="{{ Auth::guard('admin')->user()->email }}" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit" class="btn btn-rounded btn-primary btn-outline">
                            <i class="ti-save-alt"></i>
                            حفظ
                        </button>
                    </div> 
                </form>
            </div>
        </div>
    </div>

    <div class="row">			  
        <div class="col-12">
            <div class="box">
                <div class="box-header with-border">
                    <h4 class="box-title">تحديث كلمة السر</h4>
                </div>
                <!-- /.box-header -->
                <form class="form" id="update-password">
                    {{ csrf_field() }}
                    <div class="box-body">
                        <div class="form-group">
                          <label for="current_password">كلمة السر الحالية</label>
                          <input type="password" name="current_password" id="current_password" class="form-control" required>
                        </div>
                       
                        <div class="form-group">
                            <label for="new_password">كلمة السر الجديدة</label>
                            <input type="password" name="new_password" id="new_password" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="confirm_password">تأكيد كلمة السر</label>
                            <input type="password" name="confirm_password" id="confirm_password" class="form-control" required>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit" class="btn btn-rounded btn-primary btn-outline">
                            <i class="ti-save-alt"></i>
                            تحديث كلمة السر
                        </button>
                    </div> 
                </form>
            </div>
        </div>
    </div>

    <div class="row">			  
        <div class="col-12">
              <div class="box">
                <div class="box-header with-border">
                  <h4 class="box-title">اعدادات اخري</h4>
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