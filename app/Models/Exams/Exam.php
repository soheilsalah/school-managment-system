<?php

namespace App\Models\Exams;

use App\Models\EducationalStages\EducationalClass;
use App\Models\EducationalStages\EducationalStage;
use App\Models\Subjects\Subject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'description', 'educational_stage_id', 'educational_class_id', 'subject_id', 'isPublished', 'slug',
    ];

    public function belongsToEducationalStage()
    {
        return $this->belongsTo(EducationalStage::class, 'educational_stage_id', 'id');
    }

    public function belongsToEducationalClass()
    {
        return $this->belongsTo(EducationalClass::class, 'educational_class_id', 'id');
    }

    public function belongsToSubject()
    {
        return $this->belongsTo(Subject::class, 'subject_id', 'id');
    }
}
