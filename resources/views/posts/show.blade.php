@extends('layouts.app')
@section('title', '詳細表示')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
                <div class="mb-3">
                    <label for="exampleInputTitle" class="form-label">タイトル</label>
                    <input type="text" class="form-control" id="exampleInputTitle" aria-describedby="" name="title" value="{{ $post->title }}">
                </div>

                <div class="mb-3">
                    <div class="row">
                        <div class="col">
                            <label for="exampleInputDate1" class="form-label">宿泊開始日</label>
                            <input type="date" class="form-control" id="exampleInputDate1" name="date_start" value="{{ $post->date_start }}">
                        </div>
                        <div class="col">
                            <label for="exampleInputDate2" class="form-label">宿泊終了日</label>
                            <input type="date" class="form-control" id="exampleInputDate2" name="date_fin" value="{{ $post->date_fin }}">
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <div class="row">
                        <div class="col">
                            <label for="exampleInputNumber" class="form-label">宿泊可能人数</label>
                            <input type="text" class="form-control" id="exampleInpuNumber" name="number" value="{{ $post->number }}">
                        </div>
                        <div class="col">
                            <label for="exampleInputAmount" class="form-label">金額</label>
                            <input type="text" class="form-control" id="exampleInpuAmount" name="amount" value="{{ $post->amount }}">
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="exampleInputAddress" class="form-label">住所</label>
                    <input type="text" class="form-control" id="exampleInpuAddress" name="address" value="{{ $post->address }}">
                </div>

                        <div class="mb-3">
                            <label for="exampleInputImage" class="form-label">画像</label>
                            <input type="text" class="form-control" id="exampleInputImage" name="image" value="{{ $post->image }}">
                        </div>
                    
                        <div class="mb-3">
                            <label for="exampleInputContent" class="form-label">内容</label>
                            <textarea type="text" class="form-control" id="exampleInputContent" name="content">{{ $post->content }}</textarea>
                        </div>

                <div class="row">
                    <a href="{{route('posts.edit', ['id' => $post->id])}}" class="col-md-3">
                        <button type="submit" class="btn btn-secondary btn-block">編集</button>
                    </a>
                    <form action="{{route('posts.destroy', $post->id)}}" method="post" class="col-md-3">
                        @csrf
                        @method('delete')
                        <input type="submit" value="削除" class="btn btn-danger btn-block" onclick='return confirm("削除しますか？");'>
                    </form>        
                    @auth
                        @if (Auth::user()->role == 3)
                        <a href="{{route('posts.pdelete', ['id'=>$post->id])}}" class="col-md-3">
                        <button class='btn btn-warning btn-block'>表示停止</button>
                        </a>
                        @endif
                    @endauth
                    
                    <a href="{{route('posts.reserve', ['id' => $post->id])}}" class="col-md-3">
                        <button type="submit" class="btn btn-success btn-block">予約</button>
                    </a>
                    <a href="{{route('posts.violation', ['id' => $post->id])}}" class="col-md-3">
                        <button type="submit" class="btn btn-warning btn-block">違反報告</button>
                    </a>
                </div>
                
        </div>
    </div>
</div>
@endsection
