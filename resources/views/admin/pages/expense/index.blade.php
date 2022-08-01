@extends('admin.layouts.app', [
    'title' => 'المصروفات',
    'active' => 'expenses',
    'scripts' => 'pages.expense.index',
    'breadcrumb' => [
        'title' => 'المصروفات',
        'map' => [
            'لوحة التحكم' => 'admin.home',
            'المصروفات' => 'active'
        ]
    ]
]);

@section('content')
<!-- Expense Services -->
<section class="content">
    <div class="row">
        <div class="col-12">
            <div class="box">
                <div class="box-header">						
                    <h4 class="box-title">المصروفات</h4>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table id="expenses" class="table table-striped table-bordered display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>اسم الخدمة</th>
                                    <th>التكلفة</th>
                                    <th>يتم دفع كل</th>
                                    <th>ابتداء من تاريخ</th>
                                    <th>تم انشاء الخدمة بتاريخ</th>
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
<!--/ Expense Services -->
@endsection