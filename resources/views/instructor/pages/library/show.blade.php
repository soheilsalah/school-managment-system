@extends('instructor.layouts.app', [
    'title' => $book->name,
    'active' => 'library',
    'scripts' => 'pages.library.show',
    'breadcrumb' => [
        'title' => $book->name,
        'map' => [
            'لوحة التحكم' => 'instructor.home',
            'المكتبة' => 'instructor.library',
            $book->name => 'active',
        ]
    ]
]);

@section('content')
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="box">
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-4 col-sm-6">
                            <div class="box box-body b-1 text-center no-shadow">
                                <img src="{{ asset('uploads/books/'.$book->slug.'/thumbnail/'.$book->thumbnail) }}" alt="user">
                            </div>
                            <div class="clear"></div>
                        </div>
                        <div class="col-md-8 col-sm-6">
                            <h2 class="box-title mt-0">{{ $book->name }}</h2>
                            <div class="list-inline">
                                <a class="text-warning"><i class="mdi mdi-star"></i></a>
                                <a class="text-warning"><i class="mdi mdi-star"></i></a>
                                <a class="text-warning"><i class="mdi mdi-star"></i></a>
                                <a class="text-warning"><i class="mdi mdi-star"></i></a>
                                <a class="text-warning"><i class="mdi mdi-star"></i></a>
                            </div>
                            <h1 class="pro-price mb-0 mt-20">
                            @if($book->isFree == 1)
                                مجانا
                            @elseif($book->discount != null)
                                EGP {{ $book->price_after_discount }}
                                <span class="old-price">&#36;EGP {{ $book->price }}</span>
                                <span class="text-danger">{{ $book->discount }}% off</span>
                            @else
                                EGP {{ $book->price }}
                            @endif
                            </h1>
                            <hr>
                            <p>{{ $book->description }}</p>
                            <hr>
                            <div class="gap-items">
                            @if($book->isFree == 1)
                                <button class="btn btn-success"><i class="mdi mdi-shopping"></i> قم بشراء الكتاب مجانا</button>
                            @else
                                @if($book->discount != null)
                                    <button class="btn btn-primary"><i class="mdi mdi-cart-plus"></i> قم بشراء الكتاب بسعر {{ $book->price_after_discount.' EGP' }}</button>
                                @else
                                    <button class="btn btn-primary"><i class="mdi mdi-cart-plus"></i> قم بشراء الكتاب بسعر {{ $book->price.' EGP' }}</button>
                                @endif
                            @endif
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <h4 class="box-title mt-40">General Info</h4>
                            <div class="table-responsive">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td width="390">اسم الكاتب</td>
                                            <td>{{ $book->author }}</td>
                                        </tr>
                                        <tr>
                                            <td>عدد الصفحات</td>
                                            <td>{{ $book->number_of_pages }}</td>
                                        </tr>
                                        <tr>
                                            <td>ISBN</td>
                                            <td>{{ $book->isbn }}</td>
                                        </tr>
                                        <tr>
                                            <td>تم النشر بتاريخ</td>
                                            <td>{{ date('Y-m-d', strtotime($book->created_at)) }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>				
            </div>
        </div>
    </div>
</section>
<!-- /.content -->

<!-- Loading Modal -->
<div class="modal" id="loading" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content text-right">
            <div class="modal-body">
                <div class="progress text-right">
                    <div id="progressbar" class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Result Modal -->
<div class="modal" id="resModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content text-right">
            <div class="modal-body text-center">
                <div id="res"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="onCloseModal"> اغلاق النافذة </button>
            </div>
        </div>
    </div>
</div>

<!-- Error Modal -->
<div class="modal" id="error" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content text-right">
            <div class="modal-body text-center">
				<span class="fa fa-times text-danger" style="font-size: 100px;"></span>
				<h1>حدث خطاء</h1>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="onCloseModal"> اغلاق النافذة </button>
            </div>
        </div>
    </div>
</div>
@endsection