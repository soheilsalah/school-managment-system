@extends('instructor.layouts.app', [
    'title' => 'المراحل التعليمية',
    'active' => 'educational-stage',
    'scripts' => 'pages.educational-class.index',
    'breadcrumb' => [
        'title' => 'المراحل التعليمية',
        'map' => [
            'لوحة التحكم' => 'instructor.home',
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
                                    <th>اسم الصف</th>
                                    <th>اسم الفصل</th>
                                    <th>اسم المادة</th>
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
@endsection