@extends('instructor.layouts.app', [
    'title' => 'جميع كتبي الشخصية',
    'active' => 'library.my-books',
    'scripts' => 'pages.library.my-books.index',
    'breadcrumb' => [
        'title' => 'جميع كتبي الشخصية',
        'map' => [
            'لوحة التحكم' => 'instructor.home',
            'جميع كتبي الشخصية' => 'active'
        ]
    ]
]);

@section('content')
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-12">
            <div class="box">
                <div class="box-header">						
                    <h4 class="box-title">جميع كتبي الشخصية</h4>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table id="my-books" class="table table-striped table-bordered display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>اسم الكتاب</th>
                                    <th>هل تم نشر الكتاب</th>
                                    <th>تاريخ نشر الكتاب</th>
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
<!-- /.content -->

@endsection