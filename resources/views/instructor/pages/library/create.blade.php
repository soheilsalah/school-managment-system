@extends('instructor.layouts.app', [
    'title' => 'انشاء كتاب جديد',
    'active' => 'library.book.create',
    'scripts' => 'pages.library.create',
    'breadcrumb' => [
        'title' => 'انشاء كتاب جديد',
        'map' => [
            'لوحة التحكم' => 'instructor.home',
            'المكتبة' => 'instructor.library',
            'انشاء كتاب جديد' => 'active',
        ]
    ]
]);

@section('content')
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-12">
            <div class="box">
                <div class="box-header with-border">
                    <h4 class="box-title">بيانات الكتاب الجديد</h4>
                </div>
                <form id="create-new-book">
                    {{ csrf_field() }}
                    <div class="box-body">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input switch-category-input" type="radio" name="switch_category_input" id="new-category" value="new-category">
                            <label class="form-check-label" for="new-category">انشاء فئة جديدة</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input switch-category-input" type="radio" name="switch_category_input" id="choose-category" value="choose-category" checked>
                            <label class="form-check-label" for="choose-category">اختر فئة موجودة</label>
                        </div>

                        <div id="book-category-res"></div>

                        <div class="form-group">
                            <label for="book_name">اسم الكتاب</label>
                            <input type="text" class="form-control" name="book_name" id="book_name" required>
                        </div>

                        <div class="form-group">
                            <label for="thumbnail">صورة غلاف الكتاب</label>
                            <input type="file" class="form-control" name="thumbnail" id="thumbnail" required>
                        </div>

                        <div class="form-group">
                            <label for="pdf">تحميل الكتاب PDF</label>
                            <input type="file" class="form-control" name="pdf" id="pdf" required>
                        </div>

                        <div class="form-group">
                            <label for="description">شرح الكتاب</label>
                            <textarea name="description" class="form-control" id="description" cols="30" rows="10" required></textarea>
                        </div>

                        <div class="form-group">
                            <label for="number_of_pages">عدد صفحات الكتاب</label>
                            <input type="number" class="form-control" name="number_of_pages" id="number_of_pages" required>
                        </div>

                        <div class="form-group">
                            <label for="author">اسم الكاتب</label>
                            <input type="text" class="form-control" name="author" id="author" required>
                        </div>

                        <div class="form-group">
                            <label for="isbn">ISBN</label>
                            <input type="number" class="form-control" name="isbn" id="isbn" required>
                        </div>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input preview-price-opt" type="radio" name="preview_price_opt" id="with_price" value="price" checked>
                            <label class="form-check-label" for="with_price">حدد سعر</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input preview-price-opt" type="radio" name="preview_price_opt" id="for_free" value="free">
                            <label class="form-check-label" for="for_free">هل هو مجاني</label>
                        </div>
                        

                        <div id="book-price-res"></div>
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-success">انشاء الكتاب</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.box -->
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