<?php

namespace App\Models\EducationalStages;

use App\Models\Students\StudentClass;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassRoom extends Model
{
    use HasFactory;

    protected $table = 'class_rooms';

    protected $fillable = [
        'educational_class_id', 'name', 'slug',
    ];

    public function belongsToEducationalClass()
    {
        return $this->belongsTo(EducationalClass::class, 'educational_class_id', 'id');
    }

    public function students()
    {
        return $this->hasMany(StudentClass::class, 'class_room_id', 'id');
    }

    public function studentCLass()
    {
        return $this->hasOne(StudentClass::class, 'class_room_id', 'id');
    }
}
