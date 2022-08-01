<?php

namespace App\Models\Subjects;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $table = 'subjects';

    protected $fillable = [
        'name', 'slug',
    ];

    public function classes()
    {
        return $this->hasMany(EducationalClassSubject::class, 'subject_id', 'id');
    }
}
