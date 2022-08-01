<?php

namespace App\Http\Controllers\StudentParent\Pages;

use App\Http\Controllers\Controller;
use App\Models\Library\Book;

class LibraryController extends Controller
{
    public function __construct()
    {
        $this->middleware('parent.auth:parent');
    }

    public function index()
    {
        $books = Book::where('isPublished', 1)->get();

        return view('parent.pages.library.index')->with('books', $books);
    }

    public function show($slug)
    {
        $book = Book::where('slug', $slug)->first();

        $book == null ? abort(404) : true;

        return view('parent.pages.library.show')->with('book', $book);
    }
}
