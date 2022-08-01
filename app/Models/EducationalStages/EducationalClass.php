<?php

namespace App\Models\EducationalStages;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EducationalClass extends Model
{
    use HasFactory;

    protected $fillable = [
        'educational_stage_id', 'name', 'description', 'slug',
    ];

    public function belongsToEducationalStage()
    {
        return $this->belongsTo(EducationalStage::class, 'educational_stage_id', 'id');
    }

    public function classrooms()
    {
        return $this->hasMany(ClassRoom::class, 'educational_class_id', 'id');
    }

    public function terms()
    {
        return $this->hasMany(EducationalClassTerm::class, 'educational_class_id', 'id');
    }

    public function subscriptionPlan()
    {
        return $this->hasOne(EducationalClassSubscription::class, 'educational_class_id', 'id');
    }
}
