@extends('layouts.app')
@section('title', '編集')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form method="POST" action="{{ route('posts.update', ['id' => $post->id]) }}">
                @csrf
                @method('PATCH')
                <input type="hidden" name="_method" value="PUT">
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
                    

                <button type="submit" class="btn btn-primary">更新</button>
            </form>
        </div>
    </div>
</div>
@endsection
