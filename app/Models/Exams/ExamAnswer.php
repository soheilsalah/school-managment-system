<?php

namespace App\Models\Exams;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamAnswer extends Model
{
    use HasFactory;

    protected $fillable = [
        'exam_id', 'exam_question_id', 'correct_answer', 'question_score', 'user_score', 'isAnswerCorrect',
    ];

    public function belongsToExamQuestion()
    {
        return $this->belongsTo(ExamQuestion::class, 'exam_question_id', 'id');
    }

    public function belongsToExam()
    {
        return $this->belongsTo(Exam::class, 'exam_id', 'id');
    }
}
