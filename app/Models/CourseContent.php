<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseContent extends Model
{
    protected $fillable = [
        'course_id',
        'topic_id',
        'title',
        'description',
        'material_content',  // konten materi utama
        'youtube_embed_url', // link YouTube embed
        'file_path',         // path file yang diupload
        'file_name',         // nama file asli
        'announcement',      // pengumuman
        'order',
        'is_published',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'order' => 'integer',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }

    /**
     * Get the file URL if file exists
     */
    public function getFileUrlAttribute()
    {
        if ($this->file_path) {
            return asset('storage/' . $this->file_path);
        }
        return null;
    }

    /**
     * Check if content has YouTube video
     */
    public function hasVideo()
    {
        return !empty($this->youtube_embed_url);
    }

    /**
     * Get YouTube embed URL
     */
    public function getYoutubeEmbedUrl()
    {
        if (empty($this->youtube_embed_url)) {
            return null;
        }

        $youtubeUrl = $this->youtube_embed_url;
        
        // Convert YouTube URL to embed format if needed
        if (strpos($youtubeUrl, 'youtube.com/watch') !== false) {
            $videoId = '';
            if (preg_match('/[?&]v=([^&]+)/', $youtubeUrl, $matches)) {
                $videoId = $matches[1];
            }
            return 'https://www.youtube.com/embed/' . $videoId;
        } elseif (strpos($youtubeUrl, 'youtu.be/') !== false) {
            $videoId = '';
            if (preg_match('/youtu\.be\/([^?&]+)/', $youtubeUrl, $matches)) {
                $videoId = $matches[1];
            }
            return 'https://www.youtube.com/embed/' . $videoId;
        } elseif (strpos($youtubeUrl, 'youtube.com/embed/') !== false) {
            return $youtubeUrl;
        } else {
            return $youtubeUrl;
        }
    }

    /**
     * Check if content has file attachment
     */
    public function hasFile()
    {
        return !empty($this->file_path);
    }

    /**
     * Check if content has announcement
     */
    public function hasAnnouncement()
    {
        return !empty($this->announcement);
    }
}