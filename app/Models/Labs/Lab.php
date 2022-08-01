<?php

namespace App\Models\Labs;

use App\Models\EducationalStages\EducationalClass;
use App\Models\EducationalStages\EducationalStage;
use App\Models\Subjects\Subject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lab extends Model
{
    use HasFactory;

    protected $fillable = [
        'subject_id', 'educational_stage_id', 'educational_class_id', 'name', 'link', 'thumbnail', 'slug',
    ];

    public function belongsToSubject()
    {
        return $this->belongsTo(Subject::class, 'subject_id', 'id');
    }

    public function belongsToEducationalStage()
    {
        return $this->belongsTo(EducationalStage::class, 'educational_stage_id', 'id');
    }

    public function belongsToEducationalClass()
    {
        return $this->belongsTo(EducationalClass::class, 'educational_class_id', 'id');
    }
}
