@extends('parent.layouts.app', [
    'title' => 'الاشتراكات',
    'active' => 'student-subscription-'.$studentClass->belongsToStudent->slug,
    'scripts' => 'pages.subscription.index',
    'breadcrumb' => [
        'title' => 'الاشتراكات',
        'map' => [
            'لوحة التحكم' => 'parent.home',
            'الاشتراكات' => 'active'
        ]
    ]
]);

@section('content')
{{-- <section class="content">
    <div class="row">
        <div class="col-4">
            <a href="#" class="box bg-info bg-hover-danger pull-up">
                <div class="box-body">
                    <div class="d-flex align-items-center">
                        <span class="text-white icon-money font-size-40"><span class="path1"></span><span class="path2"></span></span>
                        <div class="ml-10">
                            <h4 class="text-white mb-0">انت مشترك في نظام</h4>
                            <h5 class="text-white-50 mb-0 text-light font-weight-bold">الشهري</h5>
                        </div>
                    </div>							
                </div>
            </a>
        </div>
    </div>
</section> --}}

<!-- Main content -->
<section class="content">

    <div class="row">
        <div class="col-12">
            <div class="box-header with-border">
                <i class="fa fa-check-circle text-black"></i>

                <h4 class="box-title">اختر نظام الاشتراك</h4>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="form-check">
                    <input class="form-check-input choose_plan" type="radio" name="exampleRadios" id="all_subject" value="all_subject" checked>
                    <label class="form-check-label" for="all_subject">
                        باشتراك شهري او سنوي لجميع المواد
                    </label>
                </div>

                <div class="form-check">
                    <input class="form-check-input choose_plan" type="radio" name="exampleRadios" id="specific_subject" value="specific_subject">
                    <label class="form-check-label" for="specific_subject">
                        بالمادة
                    </label>
                </div>

                <div class="form-check">
                    <input class="form-check-input choose_plan" type="radio" name="exampleRadios" id="specific_session" value="specific_session">
                    <label class="form-check-label" for="specific_session">
                        بالحصة
                    </label>
                </div>

                


                {{-- <div class="demo-radio-button">
                    

                    <input name="group1" class="choose_plan" type="radio" id="specific_session" value="specific_session" />
                    <label for="specific_session">بالحصة</label>
                </div> --}}
            </div>
            <!-- /.box-body -->
        </div>
    </div>

    <div id="subscription_plan_res"></div>
</section>
<!-- /.content -->	
@endsection