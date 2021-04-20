<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Doctor extends Model
{
    use HasFactory, HasRoles;

    protected $fillable = [
        'nid' , 'nama', 'alamat', 'jenis_kelamin', 'handphone', 'photo'
    ];

    public function user()
    {
        return $this->belongsTo('\App\Models\User');
    }

    public function diseases()
    {
        return $this->hasMany('\App\Models\Disease');
    }
}
