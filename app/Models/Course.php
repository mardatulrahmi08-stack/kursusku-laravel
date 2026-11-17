<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Course extends Model
{
    // Daftar field yang diizinkan untuk diisi secara massal (Create/Update)
    protected $fillable = [
        'code', 
        'name', 
        'description', 
        'fee', 
        'quota', 
        'start_date', 
        'status',
    ];

    // Mengubah format start_date menjadi objek tanggal (Carbon)
    protected function casts(): array
    {
        return [
            'start_date' => 'date',
        ];
    }

    // ==========================================
    // TAMBAHAN RELASI UNTUK PERTEMUAN 12
    // ==========================================

    // 1 Course memiliki banyak Enrollment
    public function enrollments(): HasMany {
        return $this->hasMany(Enrollment::class);
    }

    // 1 Course memiliki banyak Participant melalui tabel enrollments
    public function participants(): BelongsToMany {
        return $this->belongsToMany(Participant::class, 'enrollments')
                    ->withPivot('status')
                    ->withTimestamps();
    }
}