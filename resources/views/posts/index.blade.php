@extends('layouts.app')
@section('title', '投稿一覧')
@section('content')
<div class="search">
    <form action="{{ route('posts.index') }}" method="GET">
        @csrf
        <div class="container">

        <div class="form-group">
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <label for="query">キーワード</label>
                    <input type="text" name="query" value="">
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-3">
                    <label for="date_start">開始日</label>
                    <input type="date" name="date_start" value="">
                </div>
                <div class="col-md-3">
                    <label for="date_fin">終了日</label>
                    <input type="date" name="date_fin" value="">
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row justify-content-center">
                <div class="col-md-3">
                    <label for="amount_start">最低金額</label>
                    <input type="number" name="amount_start" value="">
                </div>
                <div class="col-md-3">
                    <label for="amount_fin">最高金額</label>
                    <input type="number" name="amount_fin" value="">
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-1">
                    <button type="submit">検索</button>
                </div>
            </div>
        </div>
</div>
    </form>
</div>        
<div class="container">
    <div class="row">
        @foreach ($posts as $post)
        @if($post -> del_flg==0)
        <div class="col-md-4">
            <div class="card" style="width: 18rem;">
                @if (!empty($post->image))
                <img src="{{ $post->image }}" class="card-img-top" alt="...">
                @else
                <div style="height: 200px; background-color: #e9ecef;"></div>
                @endif
                <div class="card-body">
                    <h2><a href="{{ route('posts.show', ['id' => $post->id]) }}">{{ $post->title }}</a></h2>
                    <p class="card-text">宿泊可能日</p>
                    <p class="card-text">{{ $post->date_start }}~{{ $post->date_fin }}</p>
                    <p class="card-text">人数:{{ $post->number }}人</p>
                    <p class="card-text">金額:{{ $post->amount }}円</p>
                    <small>作成日:{{ $post->created_at }}</small>
                    <a href="{{ route('posts.show', ['id' => $post->id]) }}" class="btn btn-primary">詳細画面</a>
                </div>
            </div>
        </div>
        @endif
        @endforeach
    </div>
</div>
@endsection
