<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Notification extends Model
{
    protected $fillable = [
        'user_id',
        'type',
        'title',
        'message',
        'data',
        'is_read',
        'read_at',
    ];

    protected $casts = [
        'data' => 'array',
        'is_read' => 'boolean',
        'read_at' => 'datetime',
    ];

    /**
     * Get the user that owns the notification.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Mark notification as read.
     */
    public function markAsRead(): void
    {
        $this->update([
            'is_read' => true,
            'read_at' => now(),
        ]);
    }

    /**
     * Mark notification as unread.
     */
    public function markAsUnread(): void
    {
        $this->update([
            'is_read' => false,
            'read_at' => null,
        ]);
    }

    /**
     * Scope for unread notifications.
     */
    public function scopeUnread($query)
    {
        return $query->where('is_read', false);
    }

    /**
     * Scope for read notifications.
     */
    public function scopeRead($query)
    {
        return $query->where('is_read', true);
    }

    /**
     * Get notification icon based on type.
     */
    public function getIconAttribute(): string
    {
        return match($this->type) {
            'course_enrolled' => 'fas fa-graduation-cap',
            'course_completed' => 'fas fa-certificate',
            'payment_success' => 'fas fa-credit-card',
            'payment_failed' => 'fas fa-exclamation-triangle',
            'course_updated' => 'fas fa-edit',
            'announcement' => 'fas fa-bullhorn',
            'reminder' => 'fas fa-clock',
            default => 'fas fa-bell',
        };
    }

    /**
     * Get notification color based on type.
     */
    public function getColorAttribute(): string
    {
        return match($this->type) {
            'course_enrolled' => 'text-green-600',
            'course_completed' => 'text-blue-600',
            'payment_success' => 'text-green-600',
            'payment_failed' => 'text-red-600',
            'course_updated' => 'text-yellow-600',
            'announcement' => 'text-purple-600',
            'reminder' => 'text-orange-600',
            default => 'text-gray-600',
        };
    }
}
