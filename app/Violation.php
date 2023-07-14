<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Post;
use App\User;
class Violation	extends Model
{
    public function posts()
    {
        return $this->hasMany('Post::class');
    }
}
