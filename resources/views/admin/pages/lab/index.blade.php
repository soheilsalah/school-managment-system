@extends('admin.layouts.app', [
    'title' => 'جميع المعامل',
    'active' => 'labs',
    'scripts' => 'pages.lab.index',
    'breadcrumb' => [
        'title' => 'جميع المعامل',
        'map' => [
            'لوحة التحكم' => 'admin.home',
            'جميع المعامل' => 'active',
        ]
    ]
]);

@section('content')
<!-- Instructors -->
<section class="content">
    <div class="row">
        <div class="col-12">
            <div class="box">
                <div class="box-header">						
                    <h4 class="box-title">جميع المعامل</h4>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table id="labs" class="table table-striped table-bordered display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>اسم المعمل</th>
                                    <th>ينتمي الي المرحلة التعليمية</th>
                                    <th>ينتمي الي الصف الدراسي</th>
                                    <th>المادة العلمية</th>
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
<!--/ Instructors -->
@endsection