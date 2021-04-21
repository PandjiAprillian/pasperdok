<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'tanggal', 'jam_masuk', 'jam_keluar', 'jam_kerja'
    ];

    public function attendanceable()
    {
        return $this->morphTo();
    }
}
