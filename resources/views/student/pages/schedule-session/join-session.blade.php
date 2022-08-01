@extends('student.layouts.app', [
    'title' => $scheduleSession->belongsToSubject->name,
    'active' => 'schedule-sessions',
    'scripts' => 'pages.schedule-session.join-session',
    'breadcrumb' => [
        'title' => $scheduleSession->belongsToSubject->name,
        'map' => [
            'لوحة التحكم' => 'student.home',
            $scheduleSession->belongsToSubject->name => 'active',
        ]
    ]
]);

@section('content')
<!-- Main content -->
<section class="content">
    <div class="row">
        @if($scheduleSession->isEnded == 1)
        <div class="col-12">
            <div class="jumbotron text-center">
                <h3>تم الانتهاء من الحصة</h3>
            </div>
        </div>
        @elseif(isset($abscenseAndAttendance->hasLeft) && $abscenseAndAttendance->hasLeft == 1)
        <div class="col-12">
          <div class="jumbotron text-center">
              <h3>لقد قمت بمغادرة الحصة</h3>
          </div>
      </div>
        @else
        <div class="col-12">
            <div class="row">
                <div class="box bg-lightest">
                  <div class="box-header">
                    <div class="media align-items-top p-0">
                      <a class="avatar avatar-lg status-success mx-0" href="#">
                        <img src="{{ asset('app-assets/images/avatar/2.jpg') }}" class="rounded-circle" alt="...">
                      </a>
                        <div class="d-lg-flex d-block justify-content-between align-items-center w-p100">
                            <div class="media-body mb-lg-0 mb-20">
                                <p class="font-size-16">
                                  <a class="hover-primary" href="#"><strong>حصة <span class="text-info">{{ $scheduleSession->belongsToSubject->name }}</span> بواسطة <span class="text-success">{{ $scheduleSession->belongsToInstructor->name }}</span></strong></a>
                                </p>
                                  <p class="font-size-12" id="demo"></p>
                            </div>
                            <div>
                                <ul class="list-inline mb-0 font-size-18">
                                    <li class="list-inline-item">
                                        <button class="btn btn-danger btn-sm" id="leave-session" data-schedule-session-id="{{ $scheduleSession->id }}" data-student-id="{{ Auth::guard('student')->user()->id }}"><i class="fa fa-power-off"></i></button>
                                    </li>
                                </ul>
                            </div>
                        </div>				  
                    </div>             
                  </div>
                  <div class="box-body">
                      <div class="chat-box-one2">
                        <div id="meet"></div>
                      </div>
                  </div>
                  {{-- <div class="box-footer no-border">
                     <div class="d-md-flex d-block justify-content-between align-items-center bg-white p-5 rounded20 b-1 overflow-hidden">
                            <input class="form-control b-0 py-10" type="text" placeholder="Say something...">
                            <div class="d-flex justify-content-between align-items-center mt-md-0 mt-30">
                                <button type="button" class="waves-effect waves-circle btn btn-circle mr-10 btn-outline-secondary">
                                    <i class="mdi mdi-link"></i>
                                </button>
                                <button type="button" class="waves-effect waves-circle btn btn-circle mr-10 btn-outline-secondary">
                                    <i class="mdi mdi-face"></i>
                                </button>
                                <button type="button" class="waves-effect waves-circle btn btn-circle mr-10 btn-outline-secondary">
                                    <i class="mdi mdi-microphone"></i>
                                </button>
                                <button type="button" class="waves-effect waves-circle btn btn-circle btn-primary">
                                    <i class="mdi mdi-send"></i>
                                </button>
                            </div>
                        </div>
                  </div> --}}
                </div>
            </div>
        </div>
        @endif
    </div>
</section>
<!-- /.content -->

<!-- Loading Modal -->
<div class="modal" id="loading" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content text-right">
            <div class="modal-body">
                <div class="progress text-right">
                    <div id="progressbar" class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Result Modal -->
<div class="modal" id="resModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content text-right">
            <div class="modal-body text-center">
                <div id="res"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="onCloseModal"> اغلاق النافذة </button>
            </div>
        </div>
    </div>
</div>

<!-- Error Modal -->
<div class="modal" id="error" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content text-right">
            <div class="modal-body text-center">
				<span class="fa fa-times text-danger" style="font-size: 100px;"></span>
				<h1>حدث خطاء</h1>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="onCloseModal"> اغلاق النافذة </button>
            </div>
        </div>
    </div>
</div>
@endsection