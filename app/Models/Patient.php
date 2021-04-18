<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Patient extends Model
{
    use HasFactory, HasRoles;

    public function user()
    {
        return $this->belongsTo('\App\Models\User');
    }

    public function room()
    {
        return $this->belongsTo('\App\Models\Room');
    }

    public function diseases()
    {
        return $this->belongsToMany('\App\Models\Disease');
    }
}
