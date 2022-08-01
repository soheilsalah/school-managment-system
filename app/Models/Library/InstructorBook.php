<?php

namespace App\Models\Library;

use App\Models\Instructor;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstructorBook extends Model
{
    use HasFactory;

    protected $fillable = [
        'instructor_id', 'book_id',
    ];

    public function belongsToInstructor()
    {
        return $this->belongsTo(Instructor::class, 'instructor_id', 'id');
    }

    public function belongsToBook()
    {
        return $this->belongsTo(Book::class, 'book_id', 'id');
    }
}
