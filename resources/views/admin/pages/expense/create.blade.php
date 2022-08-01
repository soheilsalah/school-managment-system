@extends('admin.layouts.app', [
    'title' => 'انشاء خدمة جديدة',
    'active' => 'expense.create',
    'scripts' => 'pages.expense.create',
    'breadcrumb' => [
        'title' => 'انشاء خدمة جديدة',
        'map' => [
            'لوحة التحكم' => 'admin.home',
            'انشاء خدمة جديدة' => 'active'
        ]
    ]
]);

@section('content')
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-12">
            <div class="box">
                <form id="create-new-expense">
                    {{ csrf_field() }}
                    <div class="box-body">
                        <div class="form-group row">
                            <div class="col-md-6 col-12">
                                <label for="service_name">اسم الخدمة</label>
                                <input type="text" class="form-control" name="service_name" id="service_name" required>
                            </div>
                            <div class="col-md-6 col-12">
                                <label for="service_cost">تكلفة الخدمة</label>
                                <input type="number" class="form-control" name="service_cost" id="service_cost" min="1" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-4 col-12">
                                <label for="duration_amount">المدة</label>
                                <input type="number" class="form-control" name="duration_amount" id="duration_amount" min="1" value="1" required>
                            </div>
                            <div class="col-md-4 col-12">
                                <label for="duration">الفترة الزمنية</label>
                                <select name="duration" id="duration" class="form-control" required>
                                    <option value="hour">ساعة</option>
                                    <option value="day">يوم</option>
                                    <option value="week">اسبوع</option>
                                    <option value="month" selected>شهر</option>
                                    <option value="year">سنة</option>
                                </select>
                            </div>
                            <div class="col-md-4 col-12">
                                <label for="start_from_date">بداية من تاريخ</label>
                                <input type="date" class="form-control" name="start_from_date" id="start_from_date" value="{{ date('Y-m-d')}}" required>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-success">انشاء الخدمة</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.box -->
    </div>
</section>
<!-- /.content -->

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