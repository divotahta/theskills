<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Ramsey\Uuid\Uuid;

class Kelas extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'type',
        'price',
        'thumbnail_location',
    ];

    public $incrementing = false; // Atur agar tidak otomatis incrementing
    protected $keyType = 'string'; // Atur tipe kunci sebagai string

    protected static function boot()
    {
        parent::boot();

        // Generate UUID saat menciptakan entri baru
        static::creating(function ($model) {
            $model->id = Uuid::uuid4()->toString();
        });
    }

    public function student()
    {
        return $this->belongsToMany(Student::class, 'kelas_students', 'kelas_id', 'student_id');
    }
    public function lesson():HasMany
    {
        return $this->hasMany(Lesson::class);
    }
}
