<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class StopUserMiddleware
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->stop_flg == 1) {
            Auth::logout();
            return redirect('/login')->withErrors('アカウントが無効化されました。');
        }

        return $next($request);
    }
}
