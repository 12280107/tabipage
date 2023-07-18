<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\LengthAwarePaginator;
use App\User;
use App\Post;
use App\Abmin;

class HomeController extends Controller
{
    public function home()
    {
        // 自分の投稿一覧を取得
        $posts = Auth::user()->posts()->orderBy('created_at', 'desc')->get();
        return view('home', compact('posts'));
    }

    public function index()
    {
        if (Auth::check()) {
            // ログイン済みの場合
            if (Auth::user()->role == 1) {
                // 一般ユーザーの場合
                return redirect()->route('home');
            } elseif (Auth::user()->role == 2) {
                // 旅館ユーザーの場合
                $posts = Auth::user()->posts()->orderBy('created_at', 'desc')->get();
                return view('home', compact('posts'));
            } elseif (Auth::user()->role == 3) {
                // 管理者の場合
                $users = User::where('role', '<>', 3)->get();
                $posts = Post::all();
                return view('admin.index', compact('users', 'posts'));
            }
        }

        // ログインしていない場合はログインページへリダイレクト
        return redirect()->route('login');
    }
}
