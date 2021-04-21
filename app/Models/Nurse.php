<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Nurse extends Model
{
    use HasFactory, HasRoles;

    protected $fillable = [
        'nip', 'nama', 'alamat', 'jenis_kelamin', 'handphone', 'photo'
    ];

    public function user()
    {
        return $this->belongsTo('\App\Models\User');
    }

    public function room()
    {
        return $this->belongsTo('\App\Models\Room');
    }

    public function attendances()
    {
        return $this->morphMany('\App\Models\Attendance', 'attendanceable');
    }
}
