<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'title',
        'description', 
        'instructor_id',
        'price',
        'video_type',
        'video_url',
        'is_public'
    ];
} 