<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Post;

class Reserve extends Model
{
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    protected $fillable = [
        'user_id', 'post_id', 'date_start', 'date_fin', 'number', 'role'
    ];
}
