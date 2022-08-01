<?php

namespace App\Models\EducationalStages;

use App\Models\Students\Student;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AbscenseAndAttendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'schedule_session_id', 'student_id', 'hasJoined', 'joined_at', 'hasLeft', 'left_at', 'endedByHost',
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
