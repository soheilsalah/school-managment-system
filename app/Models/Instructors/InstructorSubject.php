<?php

namespace App\Models\Instructors;

use App\Models\Subjects\Subject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstructorSubject extends Model
{
    use HasFactory;

    protected $table = 'instructor_subjects';

    protected $fillable = [
        'instructor_id', 'subject_id',
    ];

    public function belongsToInstructor()
    {
        return $this->belongsTo(Instructor::class, 'instructor_id', 'id');
    }

    public function belongsToSubject()
    {
        return $this->belongsTo(Subject::class, 'subject_id', 'id');
    }
}
