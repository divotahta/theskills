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
        'date_of_birth',
        'gender',
        'address',
        'bio',
        'avatar',
        'skill',
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
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'date_of_birth' => 'date',
    ];

    public function courses()
    {
        return $this->hasMany(Course::class, 'instructor_id');
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
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

    public function contentProgress()
    {
        return $this->hasMany(ContentProgress::class);
    }

    public function certificates()
    {
        return $this->hasMany(Certificate::class);
    }

    public function getStudentsCountAttribute()
    {
        return Enrollment::whereIn('course_id', $this->courses->pluck('id'))->count();
    }
}
