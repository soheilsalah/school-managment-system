@extends('admin.layouts.app', [
    'title' => $book->name,
    'active' => 'library',
    'scripts' => 'pages.library.show',
    'breadcrumb' => [
        'title' => $book->name,
        'map' => [
            'لوحة التحكم' => 'admin.home',
            'المكتبة' => 'admin.library',
            $book->name => 'active',
        ]
    ]
]);

@section('content')
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-8 col-12">
            <div class="row">
                <div class="col-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <h4 class="box-title">معلومات الكتاب</h4>
                        </div>
                        <form id="update-book-info">
                            {{ csrf_field() }}
                            <input type="hidden" name="book_id" value="{{$book->id}}">
                            <div class="box-body">
        
                                <div class="form-group">
                                    <label for="book_name">اسم الكتاب</label>
                                    <input type="text" class="form-control" name="book_name" id="book_name" value="{{$book->name}}" required>
                                </div>
        
                                <div class="form-group">
                                    <label for="description">شرح الكتاب</label>
                                    <textarea name="description" class="form-control" id="description" cols="30" rows="10" required>{{$book->description}}</textarea>
                                </div>
        
                                <div class="form-group">
                                    <label for="number_of_pages">عدد صفحات الكتاب</label>
                                    <input type="number" class="form-control" name="number_of_pages" id="number_of_pages" value="{{$book->number_of_pages}}" required>
                                </div>
        
                                <div class="form-group">
                                    <label for="author">اسم الكاتب</label>
                                    <input type="text" class="form-control" name="author" id="author" value="{{$book->author}}" required>
                                </div>
        
                                <div class="form-group">
                                    <label for="isbn">ISBN</label>
                                    <input type="number" class="form-control" name="isbn" id="isbn" value="{{$book->isbn}}" required>
                                </div>
                            </div>
                            <div class="box-footer">
                                <button type="submit" class="btn btn-success">تحديث معلومات الكتاب</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.box -->
                </div>

                <div class="col-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <h4 class="box-title">سعر الكتاب</h4>
                        </div>
                        <form id="update-book-price">
                            {{ csrf_field() }}
                            <input type="hidden" name="book_id" value="{{$book->id}}">
                            <div class="box-body">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input preview-price-opt" type="radio" name="preview_price_opt" id="with_price" value="price" data-book-id="{{ $book->id }}" {{ $book->isFree == null ? 'checked' : null }}>
                                    <label class="form-check-label" for="with_price">حدد سعر</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input preview-price-opt" type="radio" name="preview_price_opt" id="for_free" value="free" data-book-id="{{ $book->id }}" {{ $book->isFree != null ? 'checked' : null }}>
                                    <label class="form-check-label" for="for_free">هل هو مجاني</label>
                                </div>
        
                                <div id="book-price-res"></div>
        
                            </div>
                            <div class="box-footer">
                                <button type="submit" class="btn btn-success">تحديث سعر الكتاب</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.box -->
                </div>
            </div>
        </div>

        <div class="col-md-4 col-12">
            <div class="row">
                <div class="col-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <h4 class="box-title">ازاله هذا الكتاب من النظام</h4>
                        </div>
                        <form id="delete-book">
                            {{ csrf_field() }}
                            <input type="hidden" name="book_id" value="{{$book->id}}">
                            <div class="text-center">
                                <button class="btn btn-danger">مسح هذا الكتاب</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.box -->
                </div>

                <div class="col-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <h4 class="box-title">تحديث صورة غلاف الكتاب</h4>
                        </div>
                        <form id="update-book-thumbnail">
                            {{ csrf_field() }}
                            <input type="hidden" name="book_id" value="{{$book->id}}">
                            <div class="box-body">
                                <div class="form-group">
                                    <img src="{{ asset('uploads/books/'.$book->slug.'/thumbnail/'.$book->thumbnail) }}" class="img-fluid" alt="{{ $book->name }}">
                                </div>

                                <div class="form-group">
                                    <label for="thumbnail">صورة غلاف الكتاب</label>
                                    <input type="file" class="form-control" name="thumbnail" id="thumbnail" required>
                                </div>
                            </div>
                            <div class="box-footer">
                                <button type="submit" class="btn btn-success">تحديث صورة الغلاف</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.box -->
                </div>

                <div class="col-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <h4 class="box-title">تحديث كتاب PDF</h4>
                        </div>
                        <form id="update-book-pdf">
                            {{ csrf_field() }}
                            <input type="hidden" name="book_id" value="{{$book->id}}">
                            <div class="box-body">
                                <div class="form-group">
                                    <a href="{{ asset('uploads/books/'.$book->slug.'/pdf/'.$book->pdf) }}" target="_blank">رابط الكتاب PDF</a>
                                </div>

                                <div class="form-group">
                                    <label for="pdf">تحميل الكتاب PDF</label>
                                    <input type="file" class="form-control" name="pdf" id="pdf" required>
                                </div>
                            </div>
                            <div class="box-footer">
                                <button type="submit" class="btn btn-success">تحديث كتاب ال PDF</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.box -->
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