<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Post;
use App\Violation;
use App\Reserve;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        return view('posts.index')->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post = new Post;
        $post->user_id = Auth::id();
        $post->title = $request->title;
        $post->date_start = $request->date_start;
        $post->date_fin = $request->date_fin;
        $post->number = $request->number;
        $post->amount = $request->amount;
        $post->address = $request->address;
        //$post->image =$request->image;
        $post->content = $request->content;
        $post->save();

        return redirect('posts');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        return view('posts.show')->with('post', $post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        return view('posts.edit', ['post' => $post]);
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
        $post = Post::findOrFail($id);
        $post->title = $request->input('title');
        $post->date_start = $request->input('date_start');
        $post->date_fin = $request->input('date_fin');
        $post->number = $request->input('number');
        $post->amount = $request->input('amount');
        $post->address = $request->input('address');
        //$post->image = $request->input('image');        
        $post->content = $request->input('content');
        $post->save();

        return redirect()->route('posts.show', ['id' => $post->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        $post->delete();
        return redirect()->route('posts.index');
    }

    /**
     * Display the violation form for the specified post.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function violation_create($id)
    {
        return view('posts.violation', ['post_id' => $id]);
    }

    /**
     * Store the violation report for the specified post.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function violation_store(Request $request, $id)
    {
        $violation = new Violation;
        $violation->post_id = $id;
        $violation->violation = $request->violation;
        $violation->save();

        return redirect()->route('posts.show', ['id' => $id]);
    }

    /**
     * Display the reservation form for the specified post.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function reserve_create($id)
    {
        $post = Post::find($id);
        return view('posts.reserve', ['post' => $post]);
    }

    /**
     * Store the reservation for the specified post.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function reserve_store(Request $request, $id)
    {
        $reserve = new Reserve;
        $reserve->user_id = Auth::user()->id;
        $reserve->post_id = $id;
        $reserve->date_start = $request->input('date_start');
        $reserve->date_fin = $request->input('date_fin');
        $reserve->number = $request->input('number');
        $reserve->save();

        return redirect()->route('posts.show', ['id' => $id]);
    }
}
