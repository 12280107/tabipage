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
                    <div class="card" style="width: 6rem;">
                        @if (!empty($user->image))
                        <img src="{{ $post->image }}" class="card-img-start" alt="...">
                        @else
                    </div>
                        <div style="height: 50px; background-color: #e9ecef;"></div>
                        @endif
                        <div class="col">
                            <label for="formGroupExampleInput2" class="form-label">ユーザー名</label>
                            <input type="name" class="form-control" placeholder="{{ Auth::user()->name }}" aria-label="user name">
                        </div>
                        </div>                        
                        <div class="mb-3">
                            <label for="formGroupExampleInput2" class="form-label">メールアドレス</label>
                            <input type="email" class="form-control" id="formGroupExampleInput2" placeholder="{{ Auth::user()->email }}">
                        </div>
                        <div class="mb-3">
                            <label for="formGroupExampleInput2" class="form-label">パスワード</label>
                            <input type="password" class="form-control" id="formGroupExampleInput" placeholder="{{ Auth::user()->password }}">
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
