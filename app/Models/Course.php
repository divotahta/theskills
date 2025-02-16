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
        'price',
        'video_type',
        'video_url',
        'is_public',
        'thumbnail',
        'difficulty_level',
        'max_students'
    ];

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
} 