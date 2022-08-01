<?php

namespace App\Models\EducationalStages;

use App\Models\Students\StudentClass;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EducationalStage extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'slug',
    ];

    public function classes()
    {
        return $this->hasMany(EducationalClass::class, 'educational_stage_id', 'id');
    }

    public function students()
    {
        return $this->hasMany(StudentClass::class, 'educational_stage_id', 'id');
    }
}
