@extends('admin.layouts.app', [
    'title' => 'الطلبة',
    'active' => 'students',
    'scripts' => 'pages.student.index',
    'breadcrumb' => [
        'title' => 'الطلبة',
        'map' => [
            'لوحة التحكم' => 'admin.home',
            'الطلبة' => 'active'
        ]
    ]
]);

@section('content')
<!-- Students -->
<section class="content">
    <div class="row">
        <div class="col-12">
            <div class="box">
                <div class="box-header">						
                    <h4 class="box-title">جميع الطلبة</h4>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table id="students" class="table table-striped table-bordered display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>اسم الطالب</th>
                                    <th>البريد الالكتروني الخاص بطالب</th>
                                    <th>ينتمي الي مرحلة تعليمية</th>
                                    <th>ينتمي الي فصل</th>
                                    <th>ولي الأمر المسؤول عن الطالب</th>
                                    <th>تم الاتضمام بتاريخ</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--/ Students -->

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