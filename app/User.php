<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Post;
use App\User;
class User extends Authenticatable
{
    use Notifiable;

    /**
     * モデルでの属性の代入を許可する
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role', 'stop_flg', 'icon', 'updated_at',
    ];

    /**
     * 配列に含めない属性
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * ネイティブ型へのキャスト
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * ユーザーとの関連付け (1対多)
     */
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
