<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Violation;

class Post extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function violation()
    {
        return $this->hasMany(Violation::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reserve::class);
    }
}
