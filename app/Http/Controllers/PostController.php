<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Post;
use App\Violation;
use App\Reserve;
use App\User;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
public function index(Request $request)
{
    
    $count = 3;
    $query = $request->input('query'); // 検索フォームからの入力値を取得
    $date_start = $request->input('date_start'); // 日付の開始範囲を取得
    $date_fin = $request->input('date_fin'); // 日付の終了範囲を取得
    $amount_start = $request->input('amount_start'); // 金額の開始範囲を取得
    $amount_fin = $request->input('amount_fin'); // 金額の終了範囲を取得

    $post=Post::where('del_flg',0);
    
if($query){
    $post=$post->where('title', 'LIKE', "%$query%")
                 ->orWhere('content', 'LIKE', "%$query%")
                 ->orWhere('address', 'LIKE', "%$query%");
}
if($date_start){
    $post=$post->whereDate('date_start','>=',$date_start);
    // dd($post->get());
}
if($date_fin){
    $post->whereDate('date_fin','<=',$date_fin);
}

if($amount_start){
    $post->where('amount','>=',$amount_start);
}
if($amount_fin){
    $post->where('amount','<=',$amount_fin);
}

$posts=$post->limit($count)->get();

    return view('posts.index', [
        'posts' => $posts,
        'query'=>$query,
        'date_start' => $date_start,
        'date_fin' => $date_fin,
        'amount_start' => $amount_start,
        'amount_fin' => $amount_fin,
    ]);
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
        if ($request->file('image')) {
            $image=$request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('',$image,'public');
            $post->image = $image;
    }

        $post->content = $request->content;
        $post->save();

        return redirect()->route('posts.index');    
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
        if ($request->file('image')) {
            $image=$request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('',$image,'public');
            $post->image = $image;
    }

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
        $reserve->role = Auth::user()->role;
        $reserve->save();

        return redirect()->route('posts.show', ['id' => $id]);
    }

    public function pdelete($id){
        $instance = new Post;
        $post = $instance->find($id);
        $post->del_flg = 1;
        $post->save();
        return redirect()->route('admin.posts.index')->with('post', $post);

    }
    public function updateDelFlag(Request $request, $id)
    {
        $post = Post::findOrFail($id);

        // 投稿のdel_flgが0から1に変更された場合
        if ($post->del_flg == 0 && $request->input('del_flg') == 1) {
            // 関連する予約のdel_flgも1に更新
            DB::transaction(function () use ($post) {
                $post->update(['del_flg' => 1]);
                $post->reservations()->update(['del_flg' => 1]);
            });
        } else {
            // del_flgが1から0に変更された場合やdel_flgが変更されていない場合
            $post->update(['del_flg' => $request->input('del_flg', 0)]);
        }

        return redirect()->route('posts.show', ['id' => $id]);
    }
    public function more(Request $request)
    {
        $count = $request->count * 3;
        $query = $request->input('query'); // 検索フォームからの入力値を取得
        $date_start = $request->input('date_start'); // 日付の開始範囲を取得
        $date_fin = $request->input('date_fin'); // 日付の終了範囲を取得
        $amount_start = $request->input('amount_start'); // 金額の開始範囲を取得
        $amount_fin = $request->input('amount_fin'); // 金額の終了範囲を取得
        $post=Post::where('del_flg',0);
    if($query){
        $post=$post->where('title', 'LIKE', "%$query%")
                     ->orWhere('content', 'LIKE', "%$query%")
                     ->orWhere('address', 'LIKE', "%$query%");
    }
    if($date_start){
        $post=$post->whereDate('date_start','>=',$date_start);
        // dd($post->get());
    }
    if($date_fin){
        $post->whereDate('date_fin','<=',$date_fin);
    }
    
    if($amount_start){
        $post->where('amount','>=',$amount_start);
    }
    if($amount_fin){
        $post->where('amount','<=',$amount_fin);
    }
    
    $posts=$post->offset($count)->limit(3)->get();
        $counts = $count + 3;

        return array($counts, $posts);
    }
    
}