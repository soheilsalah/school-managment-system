<?php

namespace App\Http\Controllers\Instructor\Pages;

use App\Http\Controllers\Controller;
use App\Models\Instructor;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use App\Models\Library\Book;
use App\Models\Library\BookCategory;
use App\Models\Library\BookTag;
use App\Models\Library\InstructorBook;

class LibraryController extends Controller
{
    public function __construct()
    {
        $this->middleware('instructor.auth:instructor');
    }

    public function index()
    {
        $books = Book::where('isPublished', 1)->get();

        return view('instructor.pages.library.index')->with('books', $books);
    }
    
    public function create()
    {
        $instructor = Instructor::where('id', Auth::guard('instructor')->user()->id)->first();

        if($instructor->permission_to_create_book == 0){
            abort(403);
        }

        return view('instructor.pages.library.create');
    }

    public function show($slug)
    {
        $book = Book::where('slug', $slug)->first();

        $book == null ? abort(404) : true;

        return view('instructor.pages.library.show')->with('book', $book);
    }

    public function myBooks()
    {
        return view('instructor.pages.library.my-books.index');
    }

    public function myBook($slug)
    {
        $book = Book::where('slug', $slug)->first();

        if($book->instructor == null){

            return view('instructor.pages.miscellaneous.404');

        }elseif($book->instructor != null && $book->instructor->instructor_id != Auth::guard('instructor')->user()->id){

            return view('instructor.pages.miscellaneous.404');
            
        }elseif($book == null){

            return view('instructor.pages.miscellaneous.404');

        }else{

            return view('instructor.pages.library.my-books.show')->with('book', $book);
        }
    }

    public function myBooksDatatable()
    {
        $instructorBook = InstructorBook::where('instructor_id', Auth::guard('instructor')->user()->id)->get();

        return Datatables::of($instructorBook)
        ->editColumn('book_name', function ($instructorClass) {
            return '<a href="'.route('instructor.library.my-book.show', $instructorClass->belongsToBook->slug).'">'.$instructorClass->belongsToBook->name.'</a>';
        })
        ->editColumn('created_at', function ($instructorClass) {
            return date('Y-m-d h:i a', strtotime($instructorClass->belongsToBook->created_at));
        })
        ->editColumn('isPublished', function ($instructorClass) {
            return $instructorClass->isPublished == 1 ? '<span class="text-success font-weight-bold">تم النشر</span>' : '<span class="text-danger font-weight-bold">لم يتم النشر</span>';
        })
        ->rawColumns(['book_name', 'isPublished'])
        ->make(true);
    }

    // preview book category input option
    public function previewBookCatgory(Request $request)
    {
        $category_input_opt = $request->input('category_input_opt');

        if($category_input_opt == 'new-category'){

            return view('instructor.pages.library.preview.category.input');
            
        }elseif($category_input_opt == 'choose-category'){

            $bookCategories = BookCategory::get();

            return view('instructor.pages.library.preview.category.select')->with('bookCategories', $bookCategories);
        }
    }

    // preview book price options
    public function previewPriceOption(Request $request)
    {
        $book_price_opt = $request->input('book_price_opt');
        $book_id = $request->input('book_id');

        if($book_price_opt == 'price'){

            $book = Book::where('id', $book_id)->first();

            return view('instructor.pages.library.preview.price')->with('book', $book);
        }
    }

    // create new book
    public function createNewBook(Request $request)
    {
        if($request->input('book_category_name') != null){
            
            // create book category into database if not exists
            $bookCategory = BookCategory::firstOrCreate(['slug' => Str::slug($request->input('book_category_name'))],[
                'name' => $request->input('book_category_name'),
                'slug' => Str::slug($request->input('book_category_name')),
            ]);

            $book_category_id = $bookCategory->id;

        }else{

            $book_category_id = $request->input('book_category_id');
        }

        $book_name = $request->input('book_name');
        $pdf = $request->file('pdf');
        $thumbnail = $request->file('thumbnail');
        $description = nl2br($request->input('description'));
        $number_of_pages = $request->input('number_of_pages');
        $author = $request->input('author');
        $isbn = $request->input('isbn');
        $isFree = $request->input('preview_price_opt') == 'free' ? 1 : 0;
        $price = (int)$request->input('price');
        $discount = $request->input('discount');
        $price_after_discount = $request->input('price_after_discount');
        $tags = $request->input('tags') == null ? [] : explode(',', $request->input('tags'));
        $slug = md5(uniqid());

        // upload book thumbnail
        if($request->hasFile('thumbnail')){

            // book thumbnail name 
            $book_thumbnail_name = md5(uniqid());

            // book thumbnail path
            $book_thumbnail_path = public_path('uploads/books/'.$slug.'/thumbnail');

            // upload the book thumbnail
            $this->uploadFile($request, 'thumbnail', $book_thumbnail_path, $book_thumbnail_name);
        }
        
        // upload pdf book
        if($request->hasFile('pdf')){

            // book name 
            $pdf_name = md5(uniqid());

            // book path
            $book_path = public_path('uploads/books/'.$slug.'/pdf');

            // upload the pdf
            $this->uploadFile($request, 'pdf', $book_path, $pdf_name);
        }

        // create book into database
        $book = Book::firstOrCreate(['slug' => Str::slug($book_name)],[
            'book_category_id' => $book_category_id,
            'name' => $book_name,
            'thumbnail' => $book_thumbnail_name.'.'.$thumbnail->getClientOriginalExtension(),
            'pdf' => $pdf_name.'.'.$pdf->getClientOriginalExtension(),
            'description' => $description,
            'number_of_pages' => $number_of_pages,
            'author' => $author,
            'isbn' => $isbn,
            'isFree' => $isFree,
            'price' => $price,
            'discount' => $discount,
            'price_after_discount' => $price_after_discount,
            'isPublished' => 0,
            'slug' => $slug,
        ]);
        
        // create book tags into database
        if(count($tags) > 0){

            for($i = 0; $i < count($tags); $i++){
                
                BookTag::firstOrCreate(['book_id' => $book->id, 'slug' => Str::slug($tags[$i])],[
                    'book_id' => $book->id,
                    'name' => $tags[$i],
                    'slug' => Str::slug($tags[$i]),
                ]);
            }
        }

        InstructorBook::create([
            'instructor_id' => Auth::guard('instructor')->user()->id,
            'book_id' => $book->id,
        ]);

        $this->successMsg('تم اضافة كتاب جديد في المكتبة باسم <b>'.$book_name.'</b>');

        $this->redierctTo('instructor/library/my-book/show/'.$book->slug);
    }

    // update book info
    public function updateBookInfo(Request $request)
    {
        $book_id = $request->input('book_id');
        $book_name = $request->input('book_name');
        $description = nl2br($request->input('description'));
        $number_of_pages = $request->input('number_of_pages');
        $author = $request->input('author');
        $isbn = $request->input('isbn');

        Book::where('id', $book_id)->update([
            'name' => $book_name,
            'description' => $description,
            'number_of_pages' => $number_of_pages,
            'author' => $author,
            'isbn' => $isbn,
        ]);

        $this->successMsg('تم تحديث معلومات عن الكتاب');
    }

    // update book price
    public function updateBookPrice(Request $request)
    {
        $book_id = $request->input('book_id');

        switch($request->input('preview_price_opt')){

            case 'price':
                $price = $request->input('price');
                $discount = $request->input('discount');
                $price_after_discount = $request->input('price_after_discount');

                Book::where('id', $book_id)->update([
                    'isFree' => 0,
                    'price' => $price,
                    'discount' => $discount,
                    'price_after_discount' => $price_after_discount,
                ]);

                if($discount != '0'){

                    $this->successMsg('هذا الكتاب اصبح سعرة <b>'.$price_after_discount.'</b> بدلا من <del><b>'.$price.'</b></del>');
                }else{

                    $this->successMsg('هذا الكتاب اصبح سعرة <b>'.$price.'</b>');
                }
            break;

            case 'free':
                Book::where('id', $book_id)->update([
                    'isFree' => 1,
                    'price' => null,
                    'discount' => null,
                    'price_after_discount' => null,
                ]);

                $this->successMsg('هذا الكتاب اصبح مجانا');
            break;
        }
    }

    // update book thumbnail
    public function updateBookThumbnail(Request $request)
    {
        $book = Book::where('id', $request->input('book_id'))->first();

        // get old thumnail
        $old_book_thumbnail = public_path('uploads/books/'.$book->slug.'/thumbnail/'.$book->thumbnail);
        
        // remove old thumnail
        file_exists($old_book_thumbnail) ? $this->removeFile($old_book_thumbnail) : true;

        // book thumbnail name 
        $book_thumbnail_name = md5(uniqid());

        // book thumbnail path
        $book_thumbnail_path = public_path('uploads/books/'.$book->slug.'/thumbnail');

        // upload the book thumbnail
        $this->uploadFile($request, 'thumbnail', $book_thumbnail_path, $book_thumbnail_name);

        // update thumbnail book name
        $book->update([
            'thumbnail' => $book_thumbnail_name.'.'.$request->file('thumbnail')->getClientOriginalExtension(),
        ]);

        $this->successMsg('تم تحديث صورة الغلاف');

        $this->reloadPage();
    }

    // update book pdf
    public function updateBookPDF(Request $request)
    {
        $book = Book::where('id', $request->input('book_id'))->first();

        // get old pdf
        $old_book_pdf = public_path('uploads/books/'.$book->slug.'/pdf/'.$book->pdf);
        
        // remove old pdf
        file_exists($old_book_pdf) ? $this->removeFile($old_book_pdf) : true;

        // book pdf name 
        $book_pdf_name = md5(uniqid());

        // book pdf path
        $book_pdf_path = public_path('uploads/books/'.$book->slug.'/pdf');

        // upload the book pdf
        $this->uploadFile($request, 'pdf', $book_pdf_path, $book_pdf_name);

        // update pdf book name
        $book->update([
            'pdf' => $book_pdf_name.'.'.$request->file('pdf')->getClientOriginalExtension(),
        ]);

        $this->successMsg('تم تحديث كتاب ال PDF');

        $this->reloadPage();
    }

    // delete this book
    public function delete(Request $request)
    {
        $book = Book::where('id', $request->input('book_id'))->first();

        // get book directory
        $book_dir = public_path('uploads/books/'.$book->slug);

        // delete book directory
        file_exists($book_dir) ? $this->deleteDir($book_dir) : true;

        // delete book from database
        $book->delete();

        $this->successMsg('تمت ازاله هذا الكتاب من النظام');

        // redirect to library page
        $this->redierctTo('admin/library');
    }
}
