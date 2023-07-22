@extends('layouts.app')
@section('title', 'マイページ')
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
                                @if (Auth::user()->icon)
                                    <img src="{{ asset('storage/'.Auth::user()->icon) }}" class="card-img-start" alt="アイコン" style="height: 6rem;">
                                @else
                                    <div class="no-image" style="height: 100px; background-color: #f0f0f0;">
                                        No Icon
                                    </div>
                                @endif
                            </div>

                            <div class="col">
                                <label for="formGroupExampleInput2" class="form-label">ユーザー名</label>
                                <input type="text" class="form-control" placeholder="{{ Auth::user()->name }}" aria-label="user name" readonly>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="formGroupExampleInput2" class="form-label">メールアドレス</label>
                            <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="{{ Auth::user()->email }}" readonly>
                        </div>
                    </div>
                    @auth
                        @if (Auth::user()->role == 3)
                            <div class="card-footer">
                            <a href="{{ route('admin.users.index') }}" class="btn btn-primary">ユーザー一覧</a>
                            <a href="{{ route('admin.posts.index') }}" class="btn btn-primary">投稿一覧</a>
                            </div>
                        @endif
                    @endauth
                    <div class="row">
                        @auth
                            @if (Auth::user()->role == 2)
                                <a href="{{ route('posts.create') }}" class="col-md-2">
                                    <button type="submit" class="btn btn-secondary btn-block">新規投稿</button>
                                </a>
                            @endif
                        @endauth
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
</div>
@endsection

    
