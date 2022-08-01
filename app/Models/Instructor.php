<?php

namespace App\Models;

use App\Models\Instructors\InstructorReward;
use App\Models\Library\InstructorBook;
use App\Notifications\Instructor\Auth\ResetPassword;
use App\Notifications\Instructor\Auth\VerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Instructor extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'image', 'gender', 'permission_to_create_book', 'can_publish_session', 'number_of_sessions', 'slug'
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

    public function rewards()
    {
        return $this->hasMany(InstructorReward::class, 'instructor_id', 'id');
    }

    public function books()
    {
        return $this->hasMany(InstructorBook::class, 'instructor_id', 'id');
    }
}