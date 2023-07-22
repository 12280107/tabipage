@extends('layouts.app')
@section('title', 'マイページ')
@section('content')
<div class="container">
    <input type="hidden" id="count" value=0>
    <div id="content" class="row justify-content-start">
        @foreach ($posts as $post)
        <div class="col-md-4">
            <div class="card" style="width: 18rem;">
                <img src="{{'storage/'.$post->image }}" class="card-img-top" alt="..." style="object-fit:cover; width: 50; height: 50;">
                <div class="card-body">
                    <h2><a href="{{ route('posts.show', ['id' => $post->id]) }}">{{ $post->title }}</a></h2>
                    <p class="card-text">宿泊可能日</p>
                    <p class="card-text">{{ $post->date_start }}~{{ $post->date_fin }}</p>
                    <p class="card-text">人数:{{ $post->number }}人</p>
                    <p class="card-text">金額:{{ $post->amount }}円</p>
                    <small>作成日:{{ $post->created_at }}</small>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection
