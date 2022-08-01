<?php

namespace App\Models\Library;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $table = 'books';

    protected $fillable = [
        'book_category_id', 'name', 'pdf', 'thumbnail', 'description', 'number_of_pages', 'author', 'isbn', 'isFree', 'price', 'discount', 'price_after_discount', 'isPublished', 'slug',
    ];

    public function belongsToBookCategory()
    {
        return $this->belongsTo(BookCategory::class, 'book_category_id', 'id');
    }

    public function tags()
    {
        return $this->hasMany(BookTag::class, 'book_id', 'id');
    }

    public function instructor()
    {
        return $this->hasOne(InstructorBook::class, 'book_id', 'id');
    }
}
