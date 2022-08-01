@extends('parent.layouts.app', [
    'title' => 'الحصص الخاصة بالطالب : '.$student->name,
    'active' => 'student-session-'.$student->slug,
    'assets' => 'pages.student.session',
    'breadcrumb' => [
        'title' => 'الحصص الخاصة بالطالب : '.$student->name,
        'map' => [
            'لوحة التحكم' => 'parent.home',
            'الحصص الخاصة بالطالب : '.$student->name => 'active'
        ]
    ]
]);

@section('content')
<!-- Show Session Calendar -->
<section class="content">
    <div class="row">
        <div class="col-12">
            <div class="box">
                <div class="box-header">
                    <h3>حصص {{ $term->name }} من تاريح {{ $term->start_at}} الي تاريح {{ $term->end_at }}</h4>
                </div>
                <div class="box-body">
                    <div id="calendar"></div>
                </div>
            </div> 
        </div>
    </div>
</section>
<!--/ Show Session Calendar -->

<!-- Session Schedule -->              
<div class="modal fade" id="calendarModal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div id="display-session-res"></div>
        </div>
    <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.Session Schedule -->
@endsection