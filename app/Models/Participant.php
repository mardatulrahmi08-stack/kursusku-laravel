<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Participant extends Model
{
    protected $fillable = [
        'name', 'email', 'phone',
    ];

    public function enrollments(): HasMany {
        return $this->hasMany(Enrollment::class);
    }

    public function courses(): BelongsToMany {
        return $this->belongsToMany(Course::class, 'enrollments')
                    ->withPivot('status')
                    ->withTimestamps();
    }
}