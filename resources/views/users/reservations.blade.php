@extends('layouts.app')
@section('title', '予約一覧')
@section('content')
<div class="container">
    <h1>予約一覧</h1>
        <div class="row">
            @foreach($reservations as $reservation)
                @if($reservation->post)
                    <div class="col-md-4">
                        <div class="card" style="width: 18rem;">
                            <img src="{{ 'storage/' . $reservation->post->image }}" class="card-img-top" alt="..." style="object-fit:cover; width: 100%; height: 15rem;">
                            <div class="card-body">
                                <h2><a href="{{ route('posts.show', ['id' => $reservation->post->id]) }}">{{ $reservation->post->title }}</a></h2>
                                <p class="card-text">宿泊可能日: {{ $reservation->post->date_start }} ~ {{ $reservation->post->date_fin }}</p>
                                <p class="card-text">人数: {{ $reservation->post->number }}人</p>
                                <p class="card-text">金額: {{ $reservation->post->amount }}円</p>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
</div>
@endsection
