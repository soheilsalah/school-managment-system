@extends('admin.layouts.app',[
    'active' => 'admin.home',
    'title' => 'مرحبا , '.Auth::guard('admin')->user()->name,
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
                            <h1 class="font-size-40 text-white">مرحبا يا {{ Auth::guard('admin')->user()->name }}</h1>
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

    <div class="row">
    @foreach($educationalStages as $educationalStage)
        <div class="col-xl-6 col-12">
            <div class="box no-shadow mb-0 bg-transparent">
                <div class="box-header no-border px-0">
                    <h4 class="box-title">طلاب {{ $educationalStage->name }}</h4>
                    <div class="box-controls pull-right d-md-flex d-none">
                        <a href="javascript:void(0);">عرض جميع طلاب {{ $educationalStage->name }}</a>
                    </div>							
                </div>
                <div class="box-body">
                @if($educationalStage->students->count() == 0)
                    <div class="jumbotron text-center">
                        <h5>لا يوجد طلاب في {{ $educationalStage->name }}</h5>
                    </div>
                @else
                    <table class="table">
                        <thead>
                            <tr>
                                <th>اسم الطالب</th>
                                <th>ينتمي الي صف</th>
                                <th>ولي الأمر المسؤول عن الطالب</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($educationalStage->students->take(5) as $student)
                            <tr>
                                <td>{{ $student->belongsToStudent->name }}</td>
                                <td>{{ $student->belongsToEducationalClass->name }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @endif
                </div>					
            </div>
        </div>
    @endforeach
    </div>

    <div class="row justify-content-center">
        <div class="col-xl-8 col-12">
            <div class="box">
                <div class="box-body">
                    <p class="text-fade">عدد الطلاب و اولياء الامور و المدرسين</p>
                    <h3 class="mt-0 mb-20">21 h 30 min <small class="text-danger"><i class="fa fa-arrow-down ml-25 mr-5"></i> 15%</small></h3>
                    <div id="charts_widget_2_chart"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <iframe src="https://phet.colorado.edu/sims/html/diffusion/latest/diffusion_en.html" width="100%" height="100%"></iframe>
        </div>
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
