<?php

namespace App\Models\Students;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FreeSession extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id', 'number_of_free_sessions'
    ];

    public function belongsToStudent()
    {
        return $this->belongsTo(Student::class, 'student_id', 'id');
    }
}
