@extends('financial.layouts.app', [
    'title' => ' المكافآت و الحوافز',
    'active' => 'rewards-and-incentives-for-instructors',
    'scripts' => 'pages.rewards-and-incentives.index',
    'breadcrumb' => [
        'title' => ' المكافآت و الحوافز',
        'map' => [
            'لوحة التحكم' => 'financial.home',
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
                        <table id="instructors" class="table table-striped table-bordered display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>اسم المدرس</th>
                                    <th>البريد الالكتروني الخاص بالمدرس</th>
                                    <th>عدد المكافآت</th>
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