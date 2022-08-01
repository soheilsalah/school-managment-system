<?php

namespace App\Models\EducationalStages;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EducationalClassSubscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'educational_class_id', 'one_month', 'three_months', 'six_months', 'one_year',
    ];

    public function belongsToEducationalClass()
    {
        return $this->belongsTo(EducationalClass::class, 'educational_class_id', 'id');
    }
}
