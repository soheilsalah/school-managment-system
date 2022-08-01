@extends('instructor.layouts.app', [
    'title' => $scheduleSession->belongsToSubject->name,
    'active' => 'schedule-sessions',
    'scripts' => 'pages.schedule-session.start-session',
    'breadcrumb' => [
        'title' => $scheduleSession->belongsToSubject->name,
        'map' => [
            'لوحة التحكم' => 'admin.home',
            'جداول الحصص' => 'admin.schedule-sessions',
            $scheduleSession->belongsToSubject->name => 'active',
        ]
    ]
]);

@section('content')

<section class="content">
    <div class="row">
        @if($scheduleSession->isEnded == 1)
        <div class="col-12 text-center">
            <div class="jumbotron">
                <h3>لقد تم الانتهاء الحصة</h3>
            </div>
        </div>
        @elseif($scheduleSession->isStarted != null && $scheduleSession->isStarted == 1 && $scheduleSession->isEnded != 1)
        <div class="col-12 text-center">
            <div class="jumbotron">
                <h3>لقد تم بدء الحصة</h3>
                <button type="button" class="btn btn-success mt-4 font-weight-bold" id="start-session" data-schedule-session-id="{{$scheduleSession->id}}">اضغط هنا للانضمام</button>
            </div>
        </div>
        @else
        <div class="col-12 text-center">
            <div class="jumbotron">
                <h3 id="demo"></h3>
                <div id="success_res"></div>
            </div>
        </div>
        @endif

    </div>
</section>
@endsection