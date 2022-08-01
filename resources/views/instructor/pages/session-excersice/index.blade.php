@extends('instructor.layouts.app', [
    'title' => 'الواجبات المدرسية',
    'active' => 'session-excersices',
    'scripts' => 'pages.session-excersice.index',
    'breadcrumb' => [
        'title' => 'الواجبات المدرسية',
        'map' => [
            'لوحة التحكم' => 'instructor.home',
            'الواجبات المدرسية' => 'active',
        ]
    ]
]);

@section('content')
<!-- Session Excersices Table -->
<section class="content">
    <div class="row">
        <div class="col-12">
            <div class="box">
                <div class="box-header">						
                    <h4 class="box-title">جميع الواجبات المدرسية</h4>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table id="session-excersices" class="table table-striped table-bordered display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>الصف التعليمي</th>
                                    <th>اسم الحصة</th>
                                    <th>المادة</th>
                                    <th>الواجب المدرسي</th>
                                    <th>عدد الطلبة</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($scheduleSessionHomeworks as $scheduleSessionHomework)
                            <tr>
                                <td>{{ $scheduleSessionHomework->belongsToEducationalClass->name }}</td>
                                <td>{{ $scheduleSessionHomework->topic }}</td>
                                <td>{{ $scheduleSessionHomework->belongsToSubject->name }}</td>
                                <td>
                                    <a href="{{ asset('uploads/homeworks/'.$scheduleSessionHomework->belongsToEducationalStage->slug.'/'.$scheduleSessionHomework->belongsToEducationalClass->slug.'/'.$scheduleSessionHomework->belongsToInstructor->slug.'/'.$scheduleSessionHomework->homework) }}" target="_blank">رابط الواجب المدرسي</a>
                                </td>
                                <td>0</td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--/ Session Excersices Table -->
@endsection