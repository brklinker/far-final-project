<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_track extends Model
{
    use HasFactory;

    public function track()
    {
        return $this->hasMany(Track::class);
    }
}
