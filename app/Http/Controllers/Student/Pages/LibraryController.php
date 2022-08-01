<?php

namespace App\Http\Controllers\Student\Pages;

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
        $this->middleware('student.auth:student');
    }

    public function index()
    {
        $books = Book::where('isPublished', 1)->get();

        return view('student.pages.library.index')->with('books', $books);
    }

    public function show($slug)
    {
        $book = Book::where('slug', $slug)->first();

        $book == null ? abort(404) : true;

        return view('student.pages.library.show')->with('book', $book);
    }
}
