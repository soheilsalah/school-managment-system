@extends('admin.layouts.app', [
    'title' => $educationalClass->name,
    'active' => 'educational-classes',
    'scripts' => 'pages.educational-class.classroom',
    'breadcrumb' => [
        'title' => $educationalClass->name,
        'map' => [
            'لوحة التحكم' => 'admin.home',
            'الصفوف التعليمية' => 'admin.educational-classes',
            $educationalClass->name => 'active'
        ]
    ]
]);

@section('content')
<!-- Classrooms -->
<section class="content">
    <div class="row">
        <div class="col-12">
            <div class="box">
                <div class="box-header">						
                    <h4 class="box-title">جميع الصفوف و الفصول</h4>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table id="classrooms" class="table table-striped table-bordered display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>اسم الفصل</th>
                                    <th>اجمالي عدد الطلاب في الفصل</th>
                                    <th>مسح الفصل</th>
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
<!--/ Classrooms -->

<!-- Create Classroom Form -->
<section class="content">
    <div class="row">
        <div class="col-12">
            <div class="box">
                <div class="box-header">						
                    <h4 class="box-title">انشاء فصل لهذة المرحلة</h4>
                </div>
                <div class="box-body">
                    <form id="create-classroom">
                        {{ csrf_field() }}
                        <input type="hidden" name="educational_class_id" value="{{ $educationalClass->id }}">

                        <div class="repeater-default">
                            <div data-repeater-list="classrooms">
                                <div data-repeater-item>
                                    <div class="form-group">
                                        <label for="classroom">اسم الفصل</label>
                                        <input type="text" name="classroom" class="form-control" id="v" placeholder="مثال : الفصل A" required>
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
<!--/ Create Classroom Form -->

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