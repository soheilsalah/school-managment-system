@extends('admin.layouts.app', [
    'title' => 'جميع المكافآت الخاصة بالمدرس : '.$instructor->name,
    'active' => 'rewards-and-incentives-for-instructors',
    'scripts' => 'pages.rewards-and-incentives.show',
    'breadcrumb' => [
        'title' => 'جميع المكافآت الخاصة بالمدرس : '.$instructor->name,
        'map' => [
            'لوحة التحكم' => 'admin.home',
            ' المكافآت و الحوافز' => 'admin.rewards-and-incentives-for-instructors',
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
                                    <th>ازاله المكافآة</th>
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

<!-- Create Reward for Instructor Form -->
<section class="content">
    <div class="row">
        <div class="col-12">
            <div class="box">
                <div class="box-header">						
                    <h4 class="box-title">اضافة مكافآة للمدرس : {{ $instructor->name }}</h4>
                </div>
                <div class="box-body">
                    <form id="create-instructor-reward">
                        {{ csrf_field() }}
                        <input type="hidden" name="instructor_id" value="{{ $instructor->id }}">

                        <div class="repeater-default">
                            <div data-repeater-list="rewards">
                                <div data-repeater-item>
                                    <div class="form-group row">
                                        <div class="col-3">
                                            <label>اسم المكافآة (اختياري)</label>
                                            <input type="text" name="reward_name" class="form-control">
                                        </div>
                                        <div class="col-3">
                                            <label>قيمة المكافآة</label>
                                            <input type="number" name="reward_amount" class="form-control" min="0" pattern="[0-9]+" required>
                                        </div>
                                        <div class="col-3">
                                            <label>تاريخ منح المكافآة</label>
                                            <input type="date" name="rewarded_at" class="form-control" value="{{ date('Y-m-d') }}" required>
                                        </div>
                                        <div class="col-2">
                                            <button type="button" class="btn btn-danger" data-repeater-delete> <i class="ft-x"></i> ازاله</button>
                                        </div>
                                    </div>
                                    <hr>
                                </div>
                            </div>
                            <div class="form-group overflow-hidden">
                                <div class="col-12">
                                    <button type="button" data-repeater-create class="btn btn-primary">
                                        <i class="ft-plus"></i> اضافة مكافآة اخري
                                    </button>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-success">انشاء</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!--/ Create Reward for Instructor Form -->

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