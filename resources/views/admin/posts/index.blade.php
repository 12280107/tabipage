@extends('layouts.app')
@section('title', '違反報告の多い投稿一覧')
@section('content')
<div class="container">
    <input type="hidden" id="count" value=0>
    <div id="content" class="row justify-content-start">
        @foreach ($posts as $post)
        <div class="col-md-4">
            <div class="card" style="width: 18rem;">
                @if ($post->image)
                    <img src="{{ asset('storage/' . $post->image) }}" class="card-img-top" alt="..." style="object-fit:cover; width: 100%; height: 15rem;">
                @else
                    <div class="no-image" style="width: 100%; height: 15rem; background-color: #f0f0f0; display: flex; justify-content: center; align-items: center; color: #555555;">
                        No Image
                    </div>
                @endif
                <div class="card-body">
                    <h2><a href="{{ route('posts.show', ['id' => $post->id]) }}">{{ $post->title }}</a></h2>
                    <p class="card-text">宿泊可能日</p>
                    <p class="card-text">{{ $post->date_start }}~{{ $post->date_fin }}</p>
                    <p class="card-text">人数:{{ $post->number }}人</p>
                    <p class="card-text">金額:{{ $post->amount }}円</p>
                    <p class="card-text">違反報告数:{{ $post->violation_count }}</p>
                    <small>作成日:{{ $post->created_at }}</small>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
