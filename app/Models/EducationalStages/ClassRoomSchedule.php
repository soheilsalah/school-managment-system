<?php

namespace App\Models\EducationalStages;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassRoomSchedule extends Model
{
    use HasFactory;

    protected $table = 'class_room_schedule';

    protected $fillable = [
        'educational_class_term_id', 'class_room_id', 'schedule_date', 'slug'
    ];

    public function belongsToEducationalClassTerm()
    {
        return $this->belongsTo(EducationalClassTerm::class, 'educational_class_term_id', 'id');
    }

    public function belongsToClassRoom()
    {
        return $this->belongsTo(ClassRoom::class, 'class_room_id', 'id');
    }

    public function sessions()
    {
        return $this->hasMany(ClassRoomSession::class, 'class_room_schedule_id', 'id')->orderBy('start_at', 'asc');
    }
}
