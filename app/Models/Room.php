<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    public function patients()
    {
        return $this->hasMany('\App\Models\Patient');
    }

    public function nurses()
    {
        return $this->hasMany('\App\Models\Nurse');
    }
}
