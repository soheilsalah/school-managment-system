@extends('admin.layouts.app', [
    'title' => 'المواد التعليمية',
    'active' => 'subjects',
    'scripts' => 'pages.subject.index',
    'breadcrumb' => [
        'title' => 'المواد التعليمية',
        'map' => [
            'لوحة التحكم' => 'admin.home',
            'المواد التعليمية' => 'active'
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
                    <h4 class="box-title">جميع المواد التعليمية</h4>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table id="subjects" class="table table-striped table-bordered display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>اسم المادة التعليمية</th>
                                    <th>عدد الصفوف التي تنتمي اليها هذة المادة</th>
                                    <th>مسح المادة</th>
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

<!-- Create Educational Class Form -->
<section class="content">
    <div class="row">
        <div class="col-12">
            <div class="box">
                <div class="box-header">						
                    <h4 class="box-title">انشاء مادة تعليمية</h4>
                </div>
                <div class="box-body">
                    <form id="create-subject">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="subject_name">اسم المادة تعليمية</label>
                            <input type="text" class="form-control" name="subject_name" id="subject_name" required>
                        </div>

                        <div class="form-group">
                            <label>اختر صف او صفوف تعليمية</label>
                            <select class="form-control select2" multiple="multiple" name="educational_classes_id[]" data-placeholder="Select a State" style="width: 100%;">
                                @foreach($educationalClasses as $educationalClass)
                                    <option value="{{ $educationalClass->id }}">{{ $educationalClass->name }}</option>
                                @endforeach
                            </select>
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