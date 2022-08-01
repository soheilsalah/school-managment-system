<?php

namespace App\Models\Library;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookTag extends Model
{
    use HasFactory;

    protected $table = 'book_tags';

    protected $fillable = [
        'book_id', 'name', 'slug'
    ];

    public function belongsToBook()
    {
        return $this->belongsTo(Book::class, 'book_id', 'id');
    }
}
