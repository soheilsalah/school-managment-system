<?php

namespace App\Models\Library;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookCategory extends Model
{
    use HasFactory;

    protected $table = 'book_categories';

    protected $fillable = [
        'name', 'slug'
    ];

    public function books()
    {
        return $this->hasMany(Book::class, 'book_category_id', 'id');
    }
}
