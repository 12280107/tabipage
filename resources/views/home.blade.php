@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">マイページ</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="row">
                        <div class="card" style="width: 6rem;">
                            @if (!empty($post->image))
                            <img src="{{ $post->image }}" class="card-img-start" alt="...">
                            @else
                            <div style="height: 100px; background-color: #e9ecef;"></div>
                            @endif
                        </div>
                        <div class="col">
                            <label for="formGroupExampleInput2" class="form-label">ユーザー名</label>
                            <input type="text" class="form-control" placeholder="{{ Auth::user()->name }}" aria-label="user name">
                        </div>     
                        </div>
                        
                        <div class="mb-3">
                            <label for="formGroupExampleInput2" class="form-label">メールアドレス</label>
                            <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="{{ Auth::user()->email }}">
                        </div>
                        <div class="mb-3">
                            <label for="formGroupExampleInput2" class="form-label">パスワード</label>
                            <input type="text" class="form-control" id="formGroupExampleInput" placeholder="{{ Auth::user()->password }}">
                        </div>
                    </div>
                    <div class="row">
                    <a href="{{ route('posts.create') }}" class="col-md-3">
                    <button type="submit" class="btn btn-secondary btn-block">新規投稿</button>
                    </a>
                    <a href="{{ route('users.edit',[Auth::user()->id])}}" class="col-md-3">
                        <button type="submit" class="btn btn-secondary btn-block">編集</button>
                    </a>
                    <form action="" method="post" class="col-md-3">
                        @csrf
                        @method('delete')
                        <input type="submit" value="削除" class="btn btn-danger btn-block" onclick='return confirm("削除しますか？");'>
                    </form>                    

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
