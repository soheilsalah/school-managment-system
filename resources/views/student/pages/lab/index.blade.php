@extends('student.layouts.app', [
    'title' => 'المعامل',
    'active' => 'labs',
    'breadcrumb' => [
        'title' => 'المعامل',
        'map' => [
            'لوحة التحكم' => 'student.home',
            'المعامل' => 'active'
        ]
    ]
]);

@section('content')
<!-- Main content -->
<section class="content">
    <div class="row">	
        <!--card deck!-->
        @foreach($labs as $lab)
        <div class="col-md-4 col-12">
            <div class="card-deck">
                <div class="card text-center">
                    @if($lab->thumbnail == null)
                    <div class="jumbotron">
                        <h5>لا تتوافر صورة</h5>
                    </div>
                    @else
                    <img class="card-img-top" src="{{ asset('uploads/labs/'.$lab->slug.'/thumbnail/'.$lab->thumbnail) }}" alt="{{ $lab->name }}">
                    @endif
                    <div class="card-body">
                        <h4 class="card-title b-0 px-0">{{ $lab->belongsToSubject->name }}</h4>
                        <p>
                            <a href="{{ route('student.lab.show', $lab->slug) }}">{{ $lab->name }}</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</section>
@endsection