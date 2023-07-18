<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Violation;
use App\Reserve;


class Post extends Model
{
    public function user() {

        return $this->belongsTo(User::class,'user_id');
    }
}