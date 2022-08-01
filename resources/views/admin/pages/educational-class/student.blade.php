@extends('admin.layouts.app', [
    'title' => $classRoom->belongsToEducationalClass->name.' - '.$classRoom->name,
    'active' => 'educational-classes',
    'scripts' => 'pages.educational-class.student',
    'breadcrumb' => [
        'title' => $classRoom->name,
        'map' => [
            'لوحة التحكم' => 'admin.home',
            'الصفوف التعليمية' => 'admin.educational-classes',
            $classRoom->belongsToEducationalClass->name => [
                'route' => 'admin.educational-classe.classrooms',
                'slug' => [
                    $classRoom->belongsToEducationalClass->slug
                ]
            ],
            $classRoom->name => 'active',
        ]
    ]
]);

@section('content')
<!-- Students in Classroom -->
<section class="content">
    <div class="row">
        <div class="col-12">
            <div class="box">
                <div class="box-header">						
                    <h4 class="box-title">جميع الطلاب في {{ $classRoom->belongsToEducationalClass->name.' - '.$classRoom->name }}</h4>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table id="students" class="table table-striped table-bordered display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>اسم الطالب</th>
                                    <th>ازاله هذا الطالب من الفصل</th>
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
<!--/ Students in Classroom -->

<!-- Append students inside this classroon form -->
<section class="content">
    <div class="row">
        <div class="col-12">
            <div class="box">
                <div class="box-header">						
                    <h4 class="box-title">اضافة طلاب لهذا الفصل</h4>
                </div>
                <div class="box-body">
                    <form id="append-student-in-classroom">
                        {{ csrf_field() }}
                        <input type="hidden" name="classroom_id" value="{{ $classRoom->id }}">

                        <div class="form-group">
                            <label for="students">قم باختيار الطلاب</label>
                            <select class="form-control students" multiple="multiple" name="student_ids[]" id="students" data-placeholder="ابحث عن اسم الطالب او الطالبة" style="width: 100%;" dir="rtl" required>
                                @foreach($students as $student)
                                    <option value="{{ $student->id }}">{{ $student->name }}</option>
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
<!--/ Append students inside this classroon form -->

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