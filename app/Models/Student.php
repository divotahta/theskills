<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Ramsey\Uuid\Uuid;


class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'user_id',
        'birth',
        'school_name',
        'grade',
        'addres',
        'email',
        'phone',
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

    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'user_id');
    }

    public function kelas()
    {
        return $this->belongsToMany(Kelas::class, 'kelas_students', 'student_id', 'kelas_id');
    }
}
