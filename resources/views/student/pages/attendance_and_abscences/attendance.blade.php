@extends('student.layouts.app', [
    'title' => 'الحضور',
    'active' => 'attendance',
    'scripts' => 'pages.attendance_and_abscences.attendance',
    'breadcrumb' => [
        'title' => 'الحضور',
        'map' => [
            'لوحة التحكم' => 'student.home',
            'الحضور' => 'active'
        ]
    ]
]);

@section('content')
<!-- Attendance Table -->
<section class="content">
    <div class="row">
        <div class="col-12">
            <div class="box">
                <div class="box-header">						
                    <h4 class="box-title">الحضور</h4>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table id="attendance" class="table table-striped table-bordered display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>تم حضور حصة بتاريخ</th>
                                    <th>اسم المادة</th>
                                    <th>اسم المحاضر</th>
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
<!--/ Attendance Table -->
@endsection