@extends('layouts.app')
@section('title', '在庫一覧')
@section('content')
<div class="container">
    <h1>在庫一覧</h1>
    @if($posts->isEmpty())
        <p>投稿がありません</p>
    @else
    @php $count = 0; @endphp
    <div class="row">
        @foreach($posts as $post)
        @if($post)
        <div class="col-md-4">
            <div class="card" style="width: 18rem;">
                <img src="{{ 'storage/' . $post->image }}" class="card-img-top" alt="..." style="object-fit:cover; width: 100%; height: 15rem;">
                <div class="card-body">
                    <h2><a href="{{ route('posts.show', [$post->id]) }}">{{ $post->title }}</a></h2>
                    <p class="card-text">宿泊可能日: {{ $post->date_start }} ~ {{ $post->date_fin }}</p>
                    <p class="card-text">人数: {{ $post->number }}人</p>
                    <p class="card-text">金額: {{ $post->amount }}円</p>
                </div>
            </div>
        </div>
        @php $count++; @endphp
        @if($count % 3 === 0)
    </div><div class="row">
        @endif
        @endif
        @endforeach
    </div>
    @endif
</div>
@endsection
