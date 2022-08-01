@extends('instructor.layouts.app', [
    'title' => 'ارباحي الشخصية من الكتب',
    'active' => 'profit.my-books',
    'scripts' => 'pages.profit.my-books',
    'breadcrumb' => [
        'title' => 'ارباحي الشخصية من الكتب',
        'map' => [
            'لوحة التحكم' => 'instructor.home',
            'ارباحي الشخصية من الكتب' => 'active'
        ]
    ]
]);

@section('content')
<!-- Instructo Book Profits -->
<section class="content">
    <div class="row">
        <div class="col-12">
            <div class="box">
                <div class="box-header">						
                    <h4 class="box-title">ارباحي الشخصية من الكتب</h4>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table id="educational-stages" class="table table-striped table-bordered display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>اسم الكتاب</th>
                                    <th>سعر الكتاب</th>
                                    <th>تم الشراء بتاريخ</th>
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
<!--/ Instructo Book Profits -->
@endsection