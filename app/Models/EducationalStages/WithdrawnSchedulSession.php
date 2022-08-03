<?php

namespace App\Models\EducationalStages;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WithdrawnSchedulSession extends Model
{
    use HasFactory;

    protected $fillable = [
        'schedule_session_id', 'withdrawn_at',
    ];

    public function belongsToScheduleSession()
    {
        return $this->belongsTo(ScheduleSession::class, 'schedule_session_id', 'id');
    }
}
