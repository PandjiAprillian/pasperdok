<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Doctor extends Model
{
    use HasFactory, HasRoles;

    protected $fillable = [
        'nid' , 'nama', 'alamat', 'tanggal_lahir', 'jenis_kelamin', 'handphone', 'photo', 'disease_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function disease()
    {
        return $this->belongsTo(Disease::class);
    }

    public function attendances()
    {
        return $this->morphMany(Attendance::class, 'attendanceable');
    }
}
