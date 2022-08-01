@extends('admin.layouts.app', [
    'title' => 'الصفوف و الفصول',
    'active' => 'educational-classes',
    'scripts' => 'pages.educational-class.index',
    'breadcrumb' => [
        'title' => 'الصفوف و الفصول',
        'map' => [
            'لوحة التحكم' => 'admin.home',
            'الصفوف و الفصول' => 'active'
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
                    <h4 class="box-title">جميع الصفوف و الفصول</h4>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table id="educational-classes" class="table table-striped table-bordered display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>اسم الصف</th>
                                    <th>ينتمي الي مرحلة التعليمية</th>
                                    <th>عدد الفصول</th>
                                    <th>اجمالي عدد الطلاب في الصف</th>
                                    <th>مسح هذا الصف</th>
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
<!--/ Educational Classes -->

<!-- Create Educational Class Form -->
<section class="content">
    <div class="row">
        <div class="col-12">
            <div class="box">
                <div class="box-header">						
                    <h4 class="box-title">انشاء صف تعليمي</h4>
                </div>
                <div class="box-body">
                    <form id="create-educational-class">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="educational_class_name">اسم الصف التعليمي</label>
                            <input type="text" class="form-control" name="educational_class_name" id="educational_class_name" required>
                        </div>

                        <div class="form-group">
                            <label for="educational_stage_id">ينتمي الي اي مرحلة تعليمية</label>
                            <select class="form-control select2" name="educational_stage_id" id="educational_stage_id" style="width: 100%;">
                            @foreach($educationalStages as $educationalStage)
                                <option value="{{ $educationalStage->id }}">{{ $educationalStage->name }}</option>
                            @endforeach
                            </select>
                        </div>

                        <div class="repeater-default">
                            <div data-repeater-list="classrooms">
                                <div data-repeater-item>
                                    <div class="form-group">
                                        <label for="classroom">اسم الفصل (اختياري)</label>
                                        <input type="text" name="classroom" class="form-control" id="v" placeholder="مثال : الفصل A">
                                    </div>
                                    <div class="form-group col-sm-12 col-md-2 text-center mt-2">
                                        <button type="button" class="btn btn-danger" data-repeater-delete> <i class="ft-x"></i> ازاله</button>
                                    </div>
                                    <hr>
                                </div>
                            </div>
                            <div class="form-group overflow-hidden">
                                <div class="col-12">
                                    <button type="button" data-repeater-create class="btn btn-primary">
                                        <i class="ft-plus"></i> اضافة فصل اخر
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
<!--/ Create Educational Class Form -->

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