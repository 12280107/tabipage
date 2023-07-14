<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;

class HomeController extends Controller
{
    public function home() {
        // 自分の記事一覧を投稿日降順で取得
        $post = \Auth::user()->posts()->orderBy('created_at', 'desc')->get();
        $data = ['posts' => $post];
        return view('home', $data);
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {   
        if(Auth::user()&& Auth::user()->role==3){
            return view('home');
        }else{
            return view('home');
        }
    }
}
