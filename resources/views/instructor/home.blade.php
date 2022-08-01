@extends('instructor.layouts.app',[
    'active' => 'instructor.home',
    'title' => 'مرحبا , '.Auth::guard('instructor')->user()->name,
    'assets' => 'home'
])

@section('content')
<section class="content">
    <div class="box">
        <div class="box-body">
            <div class="row">
                <div class="col-12">
                    <div class="box bg-gradient-primary overflow-hidden pull-up">
                        <div class="box-body pr-0 pl-lg-50 pl-15 py-0">							
                            <div class="row align-items-center">
                                <div class="col-12 col-lg-8">
                                    <h1 class="font-size-40 text-white">مرحبا يا {{ Auth::guard('instructor')->user()->name }}</h1>
                                    <p class="text-white mb-0 font-size-20">
                                    @if(!is_array($term_info))
                                        {{ $term_info }}
                                    @else
                                        نحن الان في {{ $term_info['name'] }} من تاريخ {{ $term_info['start_at'] }} حتي تاريخ {{ $term_info['end_at'] }}
                                    @endif
                                    </p>
                                </div>
                                <div class="col-12 col-lg-4"><img src="{{ asset('app-assets/images/svg-icon/color-svg/custom-15.svg') }}" alt=""></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-2">
                    <a class="box box-link-shadow text-center pull-up" href="javascript:void(0)">
                        <div class="box-body py-25 bg-info-light px-5">
                            <p class="font-weight-600 text-info">عدد الحصص</p>
                        </div>
                        <div class="box-body">
                            <h1 class="countnm font-size-50 m-0">{{ $countAllMySessions }}</h1>
                        </div>
                    </a>
                </div>
                <div class="col-2">
                    <a class="box box-link-shadow text-center pull-up" href="javascript:void(0)">
                        <div class="box-body py-25 bg-info-light px-5">
                            <p class="font-weight-600 text-info">عدد الحصص المتبقية</p>
                        </div>
                        <div class="box-body">
                            <h1 class="countnm font-size-50 m-0">{{ $countMyNotEndedSessions }}</h1>
                        </div>
                    </a>
                </div>
                <div class="col-2">
                    <a class="box box-link-shadow text-center pull-up" href="javascript:void(0)">
                        <div class="box-body py-25 bg-info-light px-5">
                            <p class="font-weight-600 text-info">عدد الحصص المنتهية</p>
                        </div>
                        <div class="box-body">
                            <h1 class="countnm font-size-50 m-0">{{ $countMyEndedSessions }}</h1>
                        </div>
                    </a>
                </div>
                <div class="col-2">
                    <a class="box box-link-shadow text-center pull-up" href="javascript:void(0)">
                        <div class="box-body py-25 bg-info-light px-5">
                            <p class="font-weight-600 text-info">عدد الصفوف</p>
                        </div>
                        <div class="box-body">
                            <h1 class="countnm font-size-50 m-0">{{ $countMyClasses }}</h1>
                        </div>
                    </a>
                </div>
                <div class="col-2">
                    <a class="box box-link-shadow text-center pull-up" href="javascript:void(0)">
                        <div class="box-body py-25 bg-info-light px-5">
                            <p class="font-weight-600 text-info">عدد المواد</p>
                        </div>
                        <div class="box-body">
                            <h1 class="countnm font-size-50 m-0">{{ $countMySubjects }}</h1>
                        </div>
                    </a>
                </div>
                <div class="col-2">
                    <a class="box box-link-shadow text-center pull-up" href="javascript:void(0)">
                        <div class="box-body py-25 bg-info-light px-5">
                            <p class="font-weight-600 text-info">ارباحي من الحصص</p>
                        </div>
                        <div class="box-body">
                            <h1 class="countnm font-size-50 m-0">0</h1>
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
        </div>
    </div>
</section>

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
