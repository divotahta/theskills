<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Topic extends Model
{
    protected $fillable = [
        'course_id',
        'title',
        'description',
        'order',
        'duration'
    ];

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function contents()
    {
        return $this->hasMany(CourseContent::class)->orderBy('order');
    }
} 