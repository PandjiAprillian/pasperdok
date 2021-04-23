<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disease extends Model
{
    use HasFactory;

    public function doctors()
    {
        return $this->hasMany(Doctor::class);
    }

    public function patients()
    {
        return $this->belongsToMany(Patient::class)->withTimestamps();
    }
}
