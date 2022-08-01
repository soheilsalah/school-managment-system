<?php

namespace App\Models\Students;

use App\Models\EducationalStages\ClassRoom;
use App\Models\EducationalStages\EducationalClass;
use App\Models\EducationalStages\EducationalStage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentClass extends Model
{
    use HasFactory;

    protected $table = 'student_classes';

    protected $fillable = [
        'student_id', 'educational_stage_id', 'educational_class_id', 'class_room_id',
    ];

    public function belongsToStudent()
    {
        return $this->belongsTo(Student::class, 'student_id', 'id');
    }

    public function belongsToEducationalStage()
    {
        return $this->belongsTo(EducationalStage::class, 'educational_stage_id', 'id');
    }

    public function belongsToEducationalClass()
    {
        return $this->belongsTo(EducationalClass::class, 'educational_class_id', 'id');
    }

    public function belongsToClassRoom()
    {
        return $this->belongsTo(ClassRoom::class, 'class_room_id', 'id');
    }
}
