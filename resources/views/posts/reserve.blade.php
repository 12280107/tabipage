@extends('layouts.app')
@section('title', '予約')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form method="post" action="{{ route('posts.reserve_store', ['id' => $post->id]) }}">
                @csrf
                @method('PATCH')
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
                            <label for="exampleInputNumber" class="form-label">宿泊人数</label>
                            <input type="text" class="form-control" id="exampleInpuNumber" name="number" value="{{ $post->number }}">
                        </div>
                            <input type="hidden" class="btn btn-primary">
                            <input type="submit" value="予約する" >
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
