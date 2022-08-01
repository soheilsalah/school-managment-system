@extends('student.layouts.app', [
    'title' => 'الدروس الاونلاين',
    'active' => 'online-sessions',
    'scripts' => 'pages.online-session.index',
    'breadcrumb' => [
        'title' => 'الدروس الاونلاين',
        'map' => [
            'لوحة التحكم' => 'student.home',
            'الدروس الاونلاين' => 'active'
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
@endsection