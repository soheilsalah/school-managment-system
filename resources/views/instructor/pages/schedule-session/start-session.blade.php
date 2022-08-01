@extends('instructor.layouts.app', [
    'title' => $scheduleSession->belongsToSubject->name,
    'active' => 'schedule-sessions',
    'scripts' => 'pages.schedule-session.start-session',
    'breadcrumb' => [
        'title' => $scheduleSession->belongsToSubject->name,
        'map' => [
            'لوحة التحكم' => 'instructor.home',
            'جداول الحصص' => 'instructor.schedule-sessions',
            $scheduleSession->belongsToSubject->name => 'active',
        ]
    ]
]);

@section('content')

@if($scheduleSession->isStarted != null && $scheduleSession->isStarted == 1)
<section class="content">
    <div class="row">
        <div class="col-12 text-center">
            <div class="jumbotron">
                <h3>لقد تم بدء الحصة</h3>
                <a href="{{ route('instructor.session.join', $scheduleSession->join_url) }}" class="btn btn-success font-weight-bold mt-3">اضغط هنا للانضمام</a>
            </div>
        </div>
    </div>
</section>
@else
<section class="content">
    <div class="row">
        <div class="col-12 text-center">
            <div class="jumbotron">
                <h3 id="demo"></h3>
                <div id="success_res"></div>
            </div>
        </div>
    </div>
</section>
@endif

@endsection