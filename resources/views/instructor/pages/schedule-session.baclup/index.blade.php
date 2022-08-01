@extends('instructor.layouts.app', [
    'title' => 'جداول الحصص',
    'active' => 'schedule-sessions',
    'scripts' => 'pages.schedule-session.index',
    'breadcrumb' => [
        'title' => 'جداول الحصص',
        'map' => [
            'لوحة التحكم' => 'instructor.home',
            'جداول الحصص' => 'active',
        ]
    ]
]);

@section('content')
<!-- Educational Classes Table -->
<section class="content">
    <div class="row">
        <div class="col-12">
            <div class="box">
                <div class="box-header">						
                    <h4 class="box-title">جميع جداول الحصص</h4>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table id="educational-classes" class="table table-striped table-bordered display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>الصف التعليمي</th>
                                    <th>اسم الفصل</th>
                                    <th>الفصل الدراسي</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($instructorClasses as $instructorClass)
                                <tr>
                                    <td>{{ $instructorClass->belongsToEducationalClass->name }}</td>
                                    <td>
                                        <a href="{{ route('instructor.schedule-session.show', [$instructorClass->belongsToEducationalClass->id, $instructorClass->belongsToClassRoom->id, $instructorClass->belongsToTerm->id]) }}">{{ $instructorClass->belongsToClassRoom->name }}</a>
                                    </td>
                                    <td>{{ $instructorClass->belongsToTerm->name }}</td>
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
<!--/ Educational Classes Table -->
@endsection