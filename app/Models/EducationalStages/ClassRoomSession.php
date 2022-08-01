<?php

namespace App\Models\EducationalStages;

use App\Models\Instructor;
use App\Models\Subjects\Subject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassRoomSession extends Model
{
    use HasFactory;

    protected $table = 'class_room_sessions';

    protected $fillable = [
        'class_room_schedule_id', 'subject_id', 'instructor_id', 'start_at', 'end_at', 'price', 'slug'
    ];

    public function belongsToClassRoomSchedule()
    {
        return $this->belongsTo(ClassRoomSchedule::class, 'class_room_schedule_id', 'id');
    }

    public function belongsToSubject()
    {
        return $this->belongsTo(Subject::class, 'subject_id', 'id');
    }

    public function belongsToInstructor()
    {
        return $this->belongsTo(Instructor::class, 'instructor_id', 'id');
    }
}
