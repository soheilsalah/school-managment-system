<?php

namespace App\Models\Instructors;

use App\Models\EducationalStages\ClassRoom;
use App\Models\EducationalStages\EducationalClass;
use App\Models\EducationalStages\Term;
use App\Models\Instructor;
use App\Models\Subjects\Subject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstructorClass extends Model
{
    use HasFactory;

    protected $table = 'instructor_classes';

    protected $fillable = [
        'instructor_id', 'term_id', 'educational_class_id', 'class_room_id', 'subject_id',
    ];

    public function belongsToInstructor()
    {
        return $this->belongsTo(Instructor::class, 'instructor_id', 'id');
    }

    public function belongsToTerm()
    {
        return $this->belongsTo(Term::class, 'term_id', 'id');
    }

    public function belongsToEducationalClass()
    {
        return $this->belongsTo(EducationalClass::class, 'educational_class_id', 'id');
    }

    public function belongsToClassRoom()
    {
        return $this->belongsTo(ClassRoom::class, 'class_room_id', 'id');
    }

    public function belongsToSubject()
    {
        return $this->belongsTo(Subject::class, 'subject_id', 'id');
    }
}
