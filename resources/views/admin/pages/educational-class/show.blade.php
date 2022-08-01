@extends('admin.layouts.app', [
    'title' => $educationalClass->name,
    'active' => 'educational-classes',
    'scripts' => 'pages.educational-class.show',
    'breadcrumb' => [
        'title' => $educationalClass->name,
        'map' => [
            'لوحة التحكم' => 'admin.home',
            $educationalClass->name => 'active'
        ]
    ]
]);

@section('content')
<!-- Educational Classes -->
<section class="content">
    <div class="row">
        <div class="col-12">
            <div class="box">
                <div class="box-header">						
                    <h4 class="box-title">{{ $educationalClass->name }}</h4>
                </div>
                <form id="update-educational-class">
                    {{ csrf_field() }}
                    <input type="hidden" name="educational_class_id" value="{{ $educationalClass->id }}">
                    <div class="box-body">
                        <div class="row justify-content-center">
                            <div class="col-8">
                                <div class="form-group">
                                    <label for="educational_class_name">اسم الصف التعليمي</label>
                                    <input type="text" class="form-control" name="educational_class_name" id="educational_class_name" value="{{ $educationalClass->name }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="educational_class_description">نبذة عن الصف التعليمي</label>
                                    <textarea class="form-control" name="educational_class_description" id="educational_class_description" id="" cols="30" rows="3">{{ $educationalClass->description }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="subscription_plan_for_1_month">سعر الاشتراك للشهر الواحد</label>
                                    <input type="number" class="form-control" name="1_month" id="subscription_plan_for_1_month" min="1" pattern="[0-9]+" value="{{ isset($educationalClass->subscriptionPlan) && $educationalClass->subscriptionPlan->one_month != null ? $educationalClass->subscriptionPlan->one_month : null }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="subscription_plan_for_3_months">
                                        سعر الاشتراك للثلاثة اشهر
                                        <small class="text-danger font-weight-bold">( اختياري )</small>
                                    </label>
                                    <input type="number" class="form-control" name="3_months" id="subscription_plan_for_3_months" min="1" pattern="[0-9]+" value="{{ isset($educationalClass->subscriptionPlan) && $educationalClass->subscriptionPlan->three_months != null ? $educationalClass->subscriptionPlan->three_months : null }}">
                                </div>

                                <div class="form-group">
                                    <label for="subscription_plan_for_6_months">
                                        سعر الاشتراك للستة اشهر
                                        <small class="text-danger font-weight-bold">( اختياري )</small>
                                    </label>
                                    <input type="number" class="form-control" name="6_months" id="subscription_plan_for_6_months" min="1" pattern="[0-9]+" value="{{ isset($educationalClass->subscriptionPlan) && $educationalClass->subscriptionPlan->six_months != null ? $educationalClass->subscriptionPlan->six_months : null }}">
                                </div>

                                <div class="form-group">
                                    <label for="subscription_plan_for_1_year">
                                        سعر الاشتراك للسنة
                                        <small class="text-danger font-weight-bold">( اختياري )</small>
                                    </label>
                                    <input type="number" class="form-control" name="1_year" id="subscription_plan_for_1_year" min="1" pattern="[0-9]+" value="{{ isset($educationalClass->subscriptionPlan) && $educationalClass->subscriptionPlan->one_year != null ? $educationalClass->subscriptionPlan->one_year : null }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit" class="btn btn-rounded btn-primary btn-outline">
                            <i class="ti-save-alt"></i> تحديث
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<!--/ Educational Classes -->


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