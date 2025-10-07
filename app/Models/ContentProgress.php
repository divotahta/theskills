<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ContentProgress extends Model
{
    protected $fillable = [
        'user_id',
        'course_content_id',
        'is_completed',
        'completed_at',
        'time_spent',
    ];

    protected $casts = [
        'is_completed' => 'boolean',
        'completed_at' => 'datetime',
        'time_spent' => 'integer',
    ];

    /**
     * Get the user that owns the progress
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the course content that this progress belongs to
     */
    public function courseContent(): BelongsTo
    {
        return $this->belongsTo(CourseContent::class);
    }

    /**
     * Mark content as completed
     */
    public function markAsCompleted(): void
    {
        $this->update([
            'is_completed' => true,
            'completed_at' => now(),
        ]);
    }

    /**
     * Mark content as not completed
     */
    public function markAsIncomplete(): void
    {
        $this->update([
            'is_completed' => false,
            'completed_at' => null,
        ]);
    }

    /**
     * Update time spent on content
     */
    public function updateTimeSpent(int $seconds): void
    {
        $this->update([
            'time_spent' => $this->time_spent + $seconds,
        ]);
    }

    /**
     * Get formatted time spent
     */
    public function getFormattedTimeSpentAttribute(): string
    {
        $hours = floor($this->time_spent / 3600);
        $minutes = floor(($this->time_spent % 3600) / 60);
        $seconds = $this->time_spent % 60;

        if ($hours > 0) {
            return sprintf('%d:%02d:%02d', $hours, $minutes, $seconds);
        } else {
            return sprintf('%d:%02d', $minutes, $seconds);
        }
    }
}