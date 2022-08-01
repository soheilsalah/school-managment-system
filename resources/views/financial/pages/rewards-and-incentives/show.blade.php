@extends('financial.layouts.app', [
    'title' => 'جميع المكافآت الخاصة بالمدرس : '.$instructor->name,
    'active' => 'rewards-and-incentives-for-instructors',
    'scripts' => 'pages.rewards-and-incentives.show',
    'breadcrumb' => [
        'title' => 'جميع المكافآت الخاصة بالمدرس : '.$instructor->name,
        'map' => [
            'لوحة التحكم' => 'financial.home',
            ' المكافآت و الحوافز' => 'financial.rewards-and-incentives-for-instructors',
            'جميع المكافآت الخاصة بالمدرس : '.$instructor->name => 'active',
        ]
    ]
]);

@section('content')
<!-- Rewards and Incentives for Instructor -->
<section class="content">
    <div class="row">
        <div class="col-12">
            <div class="box">
                <div class="box-header">						
                    <h4 class="box-title">جميع المكافآت الخاصة بالمدرس : {{ $instructor->name }}</h4>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table id="rewards" class="table table-striped table-bordered display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>اسم المكافآة</th>
                                    <th>قيمة المكافآة</th>
                                    <th>تم منح المكافآة بتاريخ</th>
                                    <th>هل تم سحب المكافآة من المدرس</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--/ Rewards and Incentives for Instructor -->

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