<?php

namespace App\Models\Exams;

use App\Models\Students\Student;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamUser extends Model
{
    use HasFactory;

    protected $table = 'exam_students';

    protected $fillable = [
        'exam_id', 'student_id', 'username', 'email',
    ];

    public function belongsToExam()
    {
        return $this->belongsTo(Exam::class, 'exam_id', 'id');
    }

    public function belongsToStudent()
    {
        return $this->belongsTo(Student::class, 'student_id', 'id');
    }
}
