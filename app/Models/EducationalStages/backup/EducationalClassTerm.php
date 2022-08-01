<?php

namespace App\Models\EducationalStages;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EducationalClassTerm extends Model
{
    use HasFactory;

    protected $table = 'educational_class_terms';

    protected $fillable = [
        'educational_class_id', 'term_id', 'start_at', 'end_at',
    ];

    public function belongsToEducationalClass()
    {
        return $this->belongsTo(EducationalClass::class, 'educational_class_id', 'id');
    }

    public function belongsToTerm()
    {
        return $this->belongsTo(Term::class, 'term_id', 'id');
    }

    public function classRoomSchedules()
    {
        return $this->hasMany(ClassRoomSchedule::class, 'educational_class_term_id', 'id');
    }
}
