@extends('instructor.layouts.app', [
    'title' => 'ارباحي من الحصص',
    'active' => 'profit.my-sessions',
    'scripts' => 'pages.profit.my-sessions',
    'breadcrumb' => [
        'title' => 'ارباحي من الحصص',
        'map' => [
            'لوحة التحكم' => 'instructor.home',
            'ارباحي من الحصص' => 'active'
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
                    <h4 class="box-title">ارباحي من الحصص</h4>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table id="educational-stages" class="table table-striped table-bordered display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>الحصة</th>
                                    <th>سعر الحصة</th>
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