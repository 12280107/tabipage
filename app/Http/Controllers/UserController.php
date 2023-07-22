<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Post;
use App\User;
use App\Reserve;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('role', '<>', 3)->get();
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $post = new Post();
        return view('posts.create', compact('post'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
    
        // roleが1かつログインユーザーが表示中のユーザーの場合のみ、予約した投稿一覧を取得
        if (Auth::check() && Auth::user()->role == 1 && Auth::user()->id == $user->id) {
            $reserves = $user->reserves;
            return view('users.show', ['user' => $user, 'reserves' => $reserves]);
        }
    
        return view('home', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        if ($request->file('image')) {
            $image=$request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('',$image,'public');
            $user->image = $image;
    }
        $user->save();

        return redirect()->route('home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('login')->with('status', 'ユーザーを削除しました。');
    }
    public function reservations()
    {
        $user = Auth::user();
        $reservations = $user->reservations()->with('post')->get();
        return view('users.reservations', compact('reservations'));
    }
    public function stock()
    {
        $user_id = Auth::id();
        $posts = Post::where('user_id',$user_id)->get();
        
        return view('users.stock', compact('posts'));
    }

}