<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Post;
use App\User;
class Reserve extends Model
{
    public function posts()
    {
        return $this->hasMany('App\Post','App\User');
    }
}
