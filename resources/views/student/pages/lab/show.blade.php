@extends('student.layouts.app', [
    'title' => $lab->name,
    'active' => 'labs',
    'breadcrumb' => [
        'title' => $lab->name,
        'map' => [
            'لوحة التحكم' => 'student.home',
            'المعامل' => 'student.labs',
            $lab->name => 'active',
        ]
    ]
]);

@section('content')
<!-- Main content -->
<section class="content">
    <div class="row">	
        <div class="col-12">
            <div class="embed-responsive embed-responsive-16by9">
                <iframe class="embed-responsive-item" src="{{ $lab->link }}" allowfullscreen></iframe>
            </div>
        </div>
    </div>
</section>
@endsection