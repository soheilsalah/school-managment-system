@extends('student.layouts.app', [
    'title' => 'المكتبة',
    'active' => 'library',
    'scripts' => 'pages.library.index',
    'breadcrumb' => [
        'title' => 'المكتبة',
        'map' => [
            'لوحة التحكم' => 'student.home',
            'المكتبة' => 'active'
        ]
    ]
]);

@section('content')
<!-- Main content -->
<section class="content">
    <div class="row fx-element-overlay">
    @if($books->count() > 0)
        @foreach($books as $book)
        <div class="col-12 col-lg-6 col-xl-4">
            <div class="box box-default">
                <div class="fx-card-item">
                    <div class="fx-card-avatar fx-overlay-1">
                        <img src="{{ asset('uploads/books/'.$book->slug.'/thumbnail/'.$book->thumbnail) }}" alt="user">
                        <div class="fx-overlay scrl-up">						
                            <ul class="fx-info">
                                <li><a class="btn btn-outline image-popup-vertical-fit" href="{{ asset('uploads/books/'.$book->slug.'/thumbnail/'.$book->thumbnail) }}"><i class="mdi mdi-magnify"></i></a></li>
                                <li><a class="btn btn-outline" href="{{ route('student.library.book.show', $book->slug) }}"><i class="mdi mdi-settings"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="fx-card-content text-left mb-0">							
                        <div class="product-text">
                            <h2 class="pro-price text-blue">
                            @if($book->isFree)
                                مجانا
                            @else
                                @if($book->discount != null)
                                {{ $book->price_after_discount.'L.E' }}
                                <br>
                                <span><del class="text-danger">{{ $book->price.'L.E' }}</del></span>
                                @else
                                <span class="text-info">{{ $book->price }}</span>
                                @endif
                            @endif
                            </h2>
                            <h4 class="box-title mb-0">{{ $book->name }}</h4>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.box -->				  
        </div>
        @endforeach
    @else
        <div class="col-12">
            <div class="jumbotron text-center">
                <h3>لا يوجد اي كتب متوفرة في المكتبة</h3>
            </div>
        </div>
    @endif
    </div>
</section>
<!-- /.content -->
@endsection