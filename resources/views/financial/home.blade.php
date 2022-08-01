@extends('financial.layouts.app',[
    'active' => 'financial.home',
    'title' => 'مرحبا , '.Auth::guard('financial')->user()->name,
    'scripts' => 'home'
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
                            <h1 class="font-size-40 text-white">مرحبا يا {{ Auth::guard('financial')->user()->name }}</h1>
                            <p class="text-white mb-0 font-size-20">
                            
                            </p>
                        </div>
                        <div class="col-12 col-lg-4"><img src="{{ asset('images/svg-icon/color-svg/custom-15.svg') }}" alt=""></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-12">
            <div class="box box-body">
                <h6>
                    <span class="text-uppercase">ايرادات مصاريف الطلبة هذا الشهر</span>
                </h6>
                <br>
                <p class="font-size-26">0 EGP</p>
                {{-- <div class="font-size-12"><i class="ion-arrow-graph-down-right text-success mr-1"></i> %18 decrease from last month</div> --}}
            </div>
        </div>

        <div class="col-xl-4 col-12">
            <div class="box box-body">
                <h6>
                    <span class="text-uppercase">اجمالي المصروفات</span>
                </h6>
                <br>
                <p class="font-size-26">0 EGP</p>
                {{-- <div class="font-size-12"><i class="ion-arrow-graph-down-right text-success mr-1"></i> %18 decrease from last month</div> --}}
            </div>
        </div>
    </div>
</section>
<!-- / Main content -->

<!-- Parents & Students -->
<section class="content">
    <div class="row">
        <div class="col-12">
            <div class="box">
                <div class="box-header">
                    <h3>الطلبة و اولباء الامور</h3>
                </div>
                <div class="box-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>اسم ولي الامر</th>
                                <th>عدد الطلبة لهذا ولي الامر</th>
                                <th>تم الانضمام بتاريخ</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- / Parents & Students -->

<!-- Expenses -->
<section class="content">
    <div class="row">
        <div class="col-12">
            <div class="box">
                <div class="box-header">
                    <h3>المصروفات</h3>
                </div>
                <div class="box-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>اسم الخدمة</th>
                                <th>يتم الدفع كل</th>
                                <th>التكلفة</th>
                                <th>تم انشاء الخدمة بتاريخ</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- / Expenses -->
@endsection
