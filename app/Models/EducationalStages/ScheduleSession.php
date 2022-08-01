<?php

namespace App\Models\EducationalStages;

use App\Models\Instructor;
use App\Models\Subjects\Subject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScheduleSession extends Model
{
    use HasFactory;

    protected $table = 'schedule_sessions';

    protected $fillable = [
        'educational_stage_id',
        'educational_class_id',
        'instructor_id',
        'subject_id',
        'homework',
        'meeting_id',
        'topic',
        'start_at',
        'duration',
        'end_at',
        'started_at',
        'ended_at',
        'password',
        'start_url',
        'join_url',
        'price',
        'isStarted',
        'isEnded',
        'created_by',
        'slug'
    ];

    public function belongsToEducationalStage()
    {
        return $this->belongsTo(EducationalStage::class, 'educational_stage_id', 'id');
    }

    public function belongsToEducationalClass()
    {
        return $this->belongsTo(EducationalClass::class, 'educational_class_id', 'id');
    }

    public function belongsToInstructor()
    {
        return $this->belongsTo(Instructor::class, 'instructor_id', 'id');
    }

    public function belongsToSubject()
    {
        return $this->belongsTo(Subject::class, 'subject_id', 'id');
    }
}
