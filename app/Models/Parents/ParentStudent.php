<?php

namespace App\Models\Parents;

use App\Models\Students\Student;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParentStudent extends Model
{
    use HasFactory;

    protected $table = 'parent_students';

    protected $fillable = [
        'parent_id', 'student_id'
    ];

    public function belongsToParent()
    {
        return $this->belongsTo(StudentParent::class, 'parent_id', 'id');
    }

    public function belongsToStudent()
    {
        return $this->belongsTo(Student::class, 'student_id', 'id');
    }
}
