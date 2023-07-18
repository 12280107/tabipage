@extends('layouts.app')
@section('title', '投稿一覧')
@section('content')
<div class="search">
        <form action="{{ route('posts.index') }}" method="GET">
            @csrf

            <div class="form-group">
                <div>
                <label for="query">キーワード</label>
                <input type="text" name="query" value="">
                </div>
                @csrf
            <input type="date" name="date_start" value="">
            <span class="mx-3">~</span>
            <input type="date" name="date_fin" value="">
            <input type="number" name="amount_start" value="">
            <span class="mx-3">~</span>
            <input type="number" name="amount_fin" value="">
            <!-- 検索ボタン -->
            <button type="submit">検索</button></div>
        </form>

<div class="container">
    <div class="row">
        @foreach ($posts as $post)
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
        @endforeach
    </div>
</div>
@endsection
