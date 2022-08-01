@extends('admin.layouts.app', [
    'title' => 'جميع الحصص المجانية الممنوحة للطلبة',
    'active' => 'free-sessions',
    'scripts' => 'pages.free-session.index',
    'breadcrumb' => [
        'title' => 'جميع الحصص المجانية الممنوحة للطلبة',
        'map' => [
            'لوحة التحكم' => 'admin.home',
            'جميع الحصص المجانية الممنوحة للطلبة' => 'active'
        ]
    ]
]);

@section('content')
<!-- Free Sessions Stages -->
<section class="content">
    <div class="row">
        <div class="col-12">
            <div class="box">
                <div class="box-header">						
                    <h4 class="box-title">جميع جميع الحصص المجانية الممنوحة للطلبة</h4>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table id="free-sessions" class="table table-striped table-bordered display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>اسم الطالب</th>
                                    <th>عدد الحصص المجانية</th>
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
<!--/ Free Sessions Stages -->

<!-- Create Educational Stage Form -->
<section class="content">
    <div class="row">
        <div class="col-12">
            <div class="box">
                <div class="box-header">						
                    <h4 class="box-title">اعطاء حصة مجانية لطالب</h4>
                </div>
                <div class="box-body">
                    <form id="give-free-session-for-student">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="students">اختر الطالب</label>
                                    <select name="student_id" class="form-control" id="students">
                                    @foreach($students as $student)
                                        <option value="{{ $student->id }}">{{ $student->name }}</option>
                                    @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="number_of_free_sessions">عدد الحصص المجانية</label>
                                    <input type="number" class="form-control" name="number_of_free_sessions" id="number_of_free_sessions" min="0" pattern="[0-9]+" required>
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

<!-- Error-->
<div class="modal" id="error" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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