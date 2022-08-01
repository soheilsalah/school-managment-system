@extends('instructor.layouts.app', [
    'title' => ' المكافآت و الحوافز',
    'active' => 'rewards-and-incentives-for-instructors',
    'scripts' => 'pages.rewards-and-incentives.index',
    'breadcrumb' => [
        'title' => ' المكافآت و الحوافز',
        'map' => [
            'لوحة التحكم' => 'instructor.home',
            ' المكافآت و الحوافز' => 'active'
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
                    <h4 class="box-title">جميع المدرسين بعدد المكافآت</h4>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table id="rewards" class="table table-striped table-bordered display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>اسم المكافآة</th>
                                    <th>قيمة المكافآة</th>
                                    <th>تم منح المكافآة بتاريخ</th>
                                    <th>هل تم سحب المكافآة من المدرس</th>
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