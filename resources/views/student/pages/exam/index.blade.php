@extends('student.layouts.app', [
    'title' => 'جميع الامتحانات',
    'active' => 'exams',
    'scripts' => 'pages.exam.index',
    'breadcrumb' => [
        'title' => 'جميع الامتحانات',
        'map' => [
            'لوحة التحكم' => 'student.home',
            'جميع الامتحانات' => 'active'
        ]
    ]
]);

@section('content')
<!-- Exams Table -->
<section class="content">
    <div class="row">
        <div class="col-12">
            <div class="box">
                <div class="box-header">						
                    <h4 class="box-title">قائمة بجميع الامتحانات</h4>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table id="exams" class="table table-striped table-bordered display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>اسم الامتحان</th>
                                    <th>يتبع الي مادة</th>
                                    <th>انضم الامتحان</th>
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
<!--/ Exams Table -->
@endsection