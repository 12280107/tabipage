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
public function index(Request $request)
{
    $query = $request->input('query'); // 検索フォームからの入力値を取得
    $date_start = $request->input('date_start'); // 日付の開始範囲を取得
    $date_fin = $request->input('date_fin'); // 日付の終了範囲を取得
    $amount_start = $request->input('amount_start'); // 金額の開始範囲を取得
    $amount_fin = $request->input('amount_fin'); // 金額の終了範囲を取得
    // dd($request->all());
$post=Post::query();
if($query){
            $post->where('title', 'LIKE', "%$query%")
                 ->orWhere('content', 'LIKE', "%$query%")
                 ->orWhere('address', 'LIKE', "%$query%");
}
if($date_start){
   $post->where('date_start','>=','$date_start');
}
if($date_fin){
    $post->where('date_fin','<=','$date_fin');
}

if($amount_start){
    $post->where('amount','>=','$amount_start');
}
if($amount_fin){
    $post->where('amount','<=','$amount_fin');
}

$posts=$post->get();
// // データベースから絞り込み検索結果を取得
    // $posts = Post::where('title', 'LIKE', "%$query%")
    //              ->orWhere('content', 'LIKE', "%$query%")
    //              ->orWhere('address', 'LIKE', "%$query%")
    //              ->when($date_start, function ($query, $date_start) {
    //                  return $query->where('date_start', '>=', $date_start);
    //              })
    //              ->when($date_fin, function ($query, $date_fin) {
    //                  return $query->where('date_fin', '<=', $date_fin);
    //              })
    //              ->when($amount_start, function ($query, $amount_start) {
    //                  return $query->where('amount', '>=', $amount_start);
    //              })
    //              ->when($amount_fin, function ($query, $amount_fin) {
    //                  return $query->where('amount', '<=', $amount_fin);
    //              })
    //              ->get();

    return view('posts.index', [
        'posts' => $posts,
        'query'=>$query,
        'date_start' => $date_start,
        'date_fin' => $date_fin,
        'amount_start' => $amount_start,
        'amount_fin' => $amount_fin,
    ]);
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
