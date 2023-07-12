@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">ユーザー情報</div>

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
                    
                    <form action="" method="post" class="col-md-3">
                        @csrf
                        @method('delete')
                        <input type="submit" value="削除" class="btn btn-danger btn-block" onclick='return confirm("削除しますか？");'>
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
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
