<?php

namespace App\Http\Controllers;

use App\User;
use App\Post;
use App\Violation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('role', '<>', 3)->get();
        $posts = Post::all();
        return view('admin.index', compact('users', 'posts'));
    }
    
    // ...

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function showUsers()
    {
        
        $users = User::query()
        ->where('role', '<>', 3)
        ->withCount([
            'posts AS total_violation_count' => function ($query) {
                $query->where('del_flg',1);
            }
        ])->orderBy('total_violation_count', 'desc')
        ->get();
        // dd($users);
            return view('admin.users.index', compact('users'));
            
    }
    

    public function showPosts()
    {
        $posts = Post::query()
                ->where('del_flg', 0)
                ->withCount('violation')
                ->orderBy('violation_count', 'desc')
                ->take(20)
                ->get();
    // dd($posts);
        return view('admin.posts.index',compact('posts'));

    }


}
