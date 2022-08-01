@extends('parent.layouts.app', [
    'title' => 'نظام الاشتراك - '.$plan_type_title,
    'active' => 'subscriptions',
    'scripts' => 'pages.subscription.checkout',
    'breadcrumb' => [
        'title' => 'نظام الاشتراك - '.$plan_type_title,
        'map' => [
            'لوحة التحكم' => 'parent.home',
            'الاشتراكات' => 'parent.subscriptions',
            $plan_type_title => 'active',
        ]
    ]
]);


@section('content')
<section class="content">
    <div class="row">
        <div class="col-12">
            <div class="box">
                <div class="box-header">
                    <h4 class="box-title">نظام الاشتراك</h4>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>نوع الاشتراك</th>
                                    <th class="w-200">سعر الاشتراك</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                    @switch($plan_type)
                                        @case('one_month')
                                        النظام الشهري
                                        @break

                                        @case('three_months')
                                        نظام كل ثلاثة اشهر
                                        @break

                                        @case('six_months')
                                        نظام كل ستة اشهر
                                        @break

                                        @case('one_year')
                                        النظام السنوي
                                        @break
                                    @endswitch
                                    </td>
                                    <td>{{ $educationalClassSubscription->{$plan_type} }} EGP</td>
                                </tr>
                                <tr>
                                    <th colspan="1" class="text-right font-size-24 font-weight-700">الاجمالي</th>
                                    <th class="font-size-24 font-weight-700" id="sum" data-sum="{{ $educationalClassSubscription->{$plan_type} }}">EGP {{ $educationalClassSubscription->{$plan_type} }}</th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
    
                    <hr>
    
                    <div class="row">
                        <div class="col-lg-7 col-md-6 col-12">
                            <form>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">رقم الفيزا</label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-credit-card"></i></div>
                                        <input type="text" class="form-control" id="exampleInputuname" placeholder="Card Number"> </div>
                                </div>
                                <div class="row">
                                    <div class="col-7">
                                        <div class="form-group">
                                            <label>تاريخ الانتهاء</label>
                                            <input type="text" class="form-control" name="Expiry" placeholder="MM / YY" required=""> </div>
                                    </div>
                                    <div class="col-5 pull-right">
                                        <div class="form-group">
                                            <label>ال CV كود</label>
                                            <input type="text" class="form-control" name="CVC" placeholder="CVC" required=""> </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>اسم الحاصل علي الكارد</label>
                                            <input type="text" class="form-control" name="nameCard" placeholder="NAME AND SURNAME"> </div>
                                    </div>
                                </div>
                                <button class="btn btn-success" id="make-payment">Make Payment</button>
                            </form>
                        </div>
                        <div class="col-lg-5 col-md-6 col-12">
                            <h3 class="box-title mt-10">معلومات عامة</h3>
                            <h2><i class="fa fa-cc-visa text-info"></i>
                                <i class="fa fa-cc-mastercard text-danger"></i>
                            </h2>
                            <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock.</p>
                            <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.  </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection