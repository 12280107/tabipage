<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Post;
use App\Violation;
use App\Reserve;
use App\Notifications\ResetPassword;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * モデルでの属性の代入を許可する
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role', 'stop_flg', 'icon', 'updated_at', 'stop_flg',
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
    
    public function reservations()
    {
        return $this->hasMany(Reserve::class);
    }

    /**
  * パスワードリセット通知の送信
  *
  * @param string $token
  * @return void
  */
  public function sendPasswordResetNotification($token)
  {
    $this->notify(new ResetPassword($token));
  }
  public function violations()
    {
        return $this->hasMany(Violation::class);
    }
    public function getIconUrlAttribute()
    {
        if ($this->icon) {
            return asset('storage/' . $this->icon);
        } else {
            return asset('storage/default_icon.jpg');
        }
    }

}
