<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Violation;
use App\Reserve;
class Post extends Model
{
    public function user() {
        return $this->belongsTo('App\User','App\Violation');
}
}