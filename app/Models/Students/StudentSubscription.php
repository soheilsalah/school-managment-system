<?php

namespace App\Models\Students;

use App\Models\EducationalStages\EducationalClassSubscription;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentSubscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'educational_class_subscription_id', 'student_id', 'subscription_plan', 'payment_amount', 'subscription_date_start', 'subscription_date_end', 'slug'
    ];

    public function belongsToEducationalClassSubscription()
    {
        return $this->belongsTo(EducationalClassSubscription::class, 'educational_class_subscription_id', 'id');
    }

    public function belongsToStudent()
    {
        return $this->belongsTo(Student::class, 'student_id', 'id');
    }
}
