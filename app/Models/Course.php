<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'title',
        'description',
        'instructor_id',
        'category_id',
        'course_level_id',
        'price',
        'thumbnail',
        'duration',
        'language',
        'prerequisites',
        'what_you_will_learn',
        'course_includes',
        'is_public',
        'video_type',
        'video_url',
        'max_students',
        'is_published'
    ];

    public function getThumbnailUrlAttribute()
    {
        if (empty($this->thumbnail)) {
            return null;
        }

        // Jika path tidak mengandung '/', anggap di course-thumbnails (untuk kompatibilitas)
        if (!str_contains($this->thumbnail, '/')) {
            return asset('storage/course-thumbnails/' . $this->thumbnail);
        }

        return asset('storage/' . $this->thumbnail);
    }

    public function instructor()
    {
        return $this->belongsTo(User::class, 'instructor_id');
    }

    public function topics()
    {
        return $this->hasMany(Topic::class)->orderBy('order');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function courseLevel()
    {
        return $this->belongsTo(CourseLevel::class);
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function contents()
    {
        return $this->hasMany(CourseContent::class)->orderBy('order');
    }

    public function getStudentsCountAttribute()
    {
        return $this->enrollments()->count();
    }
} 