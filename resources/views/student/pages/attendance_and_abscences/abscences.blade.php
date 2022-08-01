@extends('student.layouts.app', [
    'title' => 'الغياب',
    'active' => 'abscences',
    'scripts' => 'pages.attendance_and_abscences.abscences',
    'breadcrumb' => [
        'title' => 'الغياب',
        'map' => [
            'لوحة التحكم' => 'student.home',
            'الغياب' => 'active'
        ]
    ]
]);

@section('content')
<!-- Abscences Table -->
<section class="content">
    <div class="row">
        <div class="col-12">
            <div class="box">
                <div class="box-header">						
                    <h4 class="box-title">الغياب</h4>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table id="abscences" class="table table-striped table-bordered display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>تم الغياب عن الحصة بتاريخ</th>
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
<!--/ Abscences Table -->
@endsection