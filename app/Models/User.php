<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable 
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'first_name',
        'last_name',
        'phone',
        'skill',
        'bio',
        'display_name',
        'profile_photo',
        'cover_photo',
        'role'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function courses()
    {
        return $this->hasMany(Course::class, 'instructor_id');
    }

    public function students()
    {
        return $this->hasManyThrough(
            User::class,
            Enrollment::class,
            'course_id',
            'id',
            'id',
            'user_id'
        )->whereHas('courses', function($query) {
            $query->where('instructor_id', $this->id);
        });
    }

    public function getStudentsCountAttribute()
    {
        return Enrollment::whereIn('course_id', $this->courses->pluck('id'))->count();
    }
}
