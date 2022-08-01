@extends('student.layouts.app',[
    'active' => 'student.home',
    'title' => 'مرحبا , '.Auth::guard('student')->user()->name,
    'assets' => 'home'
])

@section('content')
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-12">
            <div class="box bg-gradient-primary overflow-hidden pull-up">
                <div class="box-body pr-0 pl-lg-50 pl-15 py-0">							
                    <div class="row align-items-center">
                        <div class="col-12 col-lg-8">
                            <h1 class="font-size-40 text-white">مرحبا يا {{ Auth::guard('student')->user()->name }}</h1>
                            <p class="text-white mb-0 font-size-20">
                                انت الان في {{ $student->belongsToStudentClass->belongsToEducationalClass->name }}
                            {{-- @if(!is_array($term_info))
                                {{ $term_info }}
                            @else
                                نحن الان في {{ $term_info['name'] }} من تاريخ {{ $term_info['start_at'] }} حتي تاريخ {{ $term_info['end_at'] }}
                            @endif --}}
                            </p>
                        </div>
                        <div class="col-12 col-lg-4"><img src="{{ asset('app-assets/images/svg-icon/color-svg/custom-15.svg') }}" alt=""></div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</section>
<!-- /.content -->

<div class="row">
    <div class="col-4">
        <a class="box box-link-shadow text-center pull-up" href="javascript:void(0)">
            <div class="box-body py-25 bg-info-light px-5">
                <p class="font-weight-600 text-info">عدد الحصص المجانية المتاحة</p>
            </div>
            <div class="box-body">
                <h1 class="countnm font-size-50 m-0">{{ isset($student->freeSessions) ? $student->freeSessions->number_of_free_sessions : 0 }}</h1>
            </div>
        </a>
    </div>
</div>

<div class="row">
    <div class="box">
        <div class="box-header">						
            <h4 class="box-title">جميع الحصص</h4>
        </div>
        <div class="box-body">
            <div class="col-12">
                <div id='calendar'></div>
            </div>
        </div>
    </div>
</div>

<!-- Show Today Session -->
<section class="content">
    <div class="row">
        <div class="col-12">
            <div class="box">
                <div class="box-header">
                    <h3>حصص اليوم</h3>
                </div>
                <div class="box-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>اسم المادة</th>
                                <th>المحاضر</th>
                                <th>انضم للمحاضرة</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div> 
        </div>
    </div>
</section>
<!--/ Show Today Session -->


<!-- Attendance -->
<section class="content">
    <div class="row">
        <div class="col-md-6 col-12">
            <div class="box">
                <div class="box-header">
                    الحضور
                </div>
                <div class="box-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>اسم الحصة</th>
                                <th>المحاضر</th>
                                <th>تم الحضور بتاريخ</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-12">
            <div class="box">
                <div class="box-header">
                    الغياب
                </div>
                <div class="box-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>اسم الحصة</th>
                                <th>المحاضر</th>
                                <th>تم الغياب بتاريخ</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<!--/ Attendance -->

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
    <div class="modal-dialog modal-lg" role="document">
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
