<?php

namespace App\Models\Students;

use App\Models\EducationalStages\ScheduleSession;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentSession extends Model
{
    use HasFactory;

    protected $fillable = [
        'schedule_session_id', 'student_id', 'hasPaid', 'forFree',
    ];

    public function belongsToScheduleSession()
    {
        return $this->belongsTo(ScheduleSession::class, 'schedule_session_id', 'id');
    }

    public function belongsToStudent()
    {
        return $this->belongsTo(Student::class, 'student_id', 'id');
    }
}
