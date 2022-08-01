<?php

namespace App\Models\EducationalStages;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Term extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'start_at', 'end_at', 'slug',
    ];

    public function educationalClassTerm()
    {
        return $this->hasOne(EducationalClassTerm::class, 'term_id', 'id');
    }
}
