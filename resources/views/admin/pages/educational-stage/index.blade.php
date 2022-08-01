@extends('admin.layouts.app', [
    'title' => 'المراحل التعليمية',
    'active' => 'educational-stage',
    'scripts' => 'pages.educational-stage.index',
    'breadcrumb' => [
        'title' => 'المراحل التعليمية',
        'map' => [
            'لوحة التحكم' => 'admin.home',
            'المراحل التعليمية' => 'active'
        ]
    ]
]);

@section('content')
<!-- Educational Stages -->
<section class="content">
    <div class="row">
        <div class="col-12">
            <div class="box">
                <div class="box-header">						
                    <h4 class="box-title">جميع المراحل التعليمية</h4>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table id="educational-stages" class="table table-striped table-bordered display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>اسم المراحلة التعليمية</th>
                                    <th>عدد الصفوف</th>
                                    <th>اجمالي عدد الطلاب في المرحلة</th>
                                    <th>شرح عن المرحلة التعليمية</th>
                                    <th>مسح المراحلة التعليمية</th>
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
<!--/ Educational Stages -->

<!-- Create Educational Stage Form -->
<section class="content">
    <div class="row">
        <div class="col-12">
            <div class="box">
                <div class="box-header">						
                    <h4 class="box-title">انشاء مرحلة تعليمية</h4>
                </div>
                <div class="box-body">
                    <form id="create-educational-stage">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="educational_stage_name">اسم المرحلة التعليمية</label>
                            <input type="text" class="form-control" name="educational_stage_name" id="educational_stage_name" required>
                        </div>

                        <div class="form-group">
                            <label for="educational_stage_description">شرح المرحلة التعليمية (اختياري)</label>
                            <textarea name="educational_stage_description" class="form-control" id="educational_stage_description" cols="30" rows="5"></textarea>
                        </div>

                        <button type="submit" class="btn btn-success">انشاء</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!--/ Create Educational Stage Form -->

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
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="onCloseModal"> Close Window </button>
            </div>
        </div>
    </div>
</div>
@endsection