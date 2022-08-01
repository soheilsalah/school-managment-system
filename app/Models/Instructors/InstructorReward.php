<?php

namespace App\Models\Instructors;

use App\Models\Instructor;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstructorReward extends Model
{
    use HasFactory;

    protected $fillable = [
        'instructor_id', 'reward_name', 'reward_amount', 'rewarded_at', 'isWithdrawn'
    ];

    public function belongsToInstructor()
    {
        return $this->belongsTo(Instructor::class, 'instructor_id', 'id');
    }
}
