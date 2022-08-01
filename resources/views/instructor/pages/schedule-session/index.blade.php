@extends('instructor.layouts.app', [
    'title' => 'جداول الحصص',
    'active' => 'schedule-sessions',
    'scripts' => 'pages.schedule-session.index',
    'breadcrumb' => [
        'title' => 'جداول الحصص',
        'map' => [
            'لوحة التحكم' => 'instructor.home',
            'جداول الحصص' => 'active'
        ]
    ]
]);

@section('content')
<!-- Schedule Sessions Table -->
<section class="content">
    <div class="row">
        <div class="col-12">
            <div class="box">
                <div class="box-header">						
                    <h4 class="box-title">جميع جداول الحصص</h4>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table id="schedule-sessions" class="table table-striped table-bordered display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>المرحلة التعليمية</th>
                                    <th>اسم الصف</th>
                                    <th>اسم المحاضر</th>
                                    <th>اسم المادة</th>
                                    <th>رابط بدء الحصة</th>
                                    <th>رابط الانضمام الحصة</th>
                                    <th>مواعيد الحصة</th>
                                </tr>
                            </thead>
                            <tbody>
                            
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--/ Schedule Sessions Table -->

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