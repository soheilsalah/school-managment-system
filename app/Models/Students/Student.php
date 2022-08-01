<?php

namespace App\Models\Students;

use App\Models\EducationalStages\ClassRoom;
use App\Models\Parents\ParentStudent;
use App\Notifications\Student\Auth\ResetPassword;
use App\Notifications\Student\Auth\VerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Student extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'image', 'gender', 'slug'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }

    /**
     * Send the email verification notification.
     *
     * @return void
     */
    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmail);
    }

    public function parentStudent()
    {
        return $this->hasOne(ParentStudent::class, 'student_id', 'id');
    }

    public function belongsToStudentClass()
    {
        return $this->hasOne(StudentClass::class, 'student_id', 'id');
    }

    public function freeSessions()
    {
        return $this->hasOne(FreeSession::class, 'student_id', 'id');
    }
}