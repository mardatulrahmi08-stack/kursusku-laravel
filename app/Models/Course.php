<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
}