@extends('admin.layouts.app', [
    'title' => 'عرض جميع الامتحانات',
    'active' => 'exams',
    'scripts' => 'pages.exam.index',
    'breadcrumb' => [
        'title' => 'عرض جميع الامتحانات',
        'map' => [
            'لوحة التحكم' => 'admin.home',
            'عرض جميع الامتحانات' => 'active'
        ]
    ]
]);

@section('content')
<!-- List of all Exams Table -->
<section class="content">
    <div class="row">
        <div class="col-12">
            <div class="box">
                <div class="box-header">						
                    <h4 class="box-title">جميع جداول الحصص</h4>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table id="exams" class="table table-striped table-bordered display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>المرحلة التعليمية</th>
                                    <th>اسم الصف</th>
                                    <th>اسم الامتحان</th>
                                    <th>يتبع لمادة</th>
                                    <th>هل تم النشر</th>
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
<!--/ List of all Exams Table -->
@endsection