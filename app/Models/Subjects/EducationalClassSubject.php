<?php

namespace App\Models\Subjects;

use App\Models\EducationalStages\EducationalClass;
use App\Models\EducationalStages\ScheduleSession;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EducationalClassSubject extends Model
{
    use HasFactory;

    protected $table = 'educational_class_subjects';

    protected $fillable = [
        'subject_id', 'educational_class_id',
    ];

    public function belongsToSubject()
    {
        return $this->belongsTo(Subject::class, 'subject_id', 'id');
    }

    public function belongsToEducationalClass()
    {
        return $this->belongsTo(EducationalClass::class, 'educational_class_id', 'id');
    }

    public function scheduleSessions()
    {
        return $this->hasMany(ScheduleSession::class, 'subject_id', 'id');
    }
}
