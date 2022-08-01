@extends('admin.layouts.app', [
    'title' => 'أولياء الأمور',
    'active' => 'parents',
    'scripts' => 'pages.parent.index',
    'breadcrumb' => [
        'title' => 'أولياء الأمور',
        'map' => [
            'لوحة التحكم' => 'admin.home',
            'أولياء الأمور' => 'active'
        ]
    ]
]);

@section('content')
<!-- Parents -->
<section class="content">
    <div class="row">
        <div class="col-12">
            <div class="box">
                <div class="box-header">						
                    <h4 class="box-title">جميع أولياء الأمور</h4>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table id="parents" class="table table-striped table-bordered display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>اسم ولي الأمر</th>
                                    <th>البريد الالكتروني الخاص بولي الأمر</th>
                                    <th>عدد الطلبة المنتمين لولي الأمر</th>
                                    <th>تم الاتضمام بتاريخ</th>
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
<!--/ Parents -->
@endsection