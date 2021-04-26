<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama', 'alamat', 'jenis_kelamin', 'handphone', 'photo'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
