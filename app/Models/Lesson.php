<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Ramsey\Uuid\Uuid;

class Lesson extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'kelas_id',
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

    public function kelas(): BelongsTo
    {
        return $this->belongsTo(Kelas::class);
    }
    public function sublesson():HasMany
    {
        return $this->hasMany(Sublesson::class);
    }
}
