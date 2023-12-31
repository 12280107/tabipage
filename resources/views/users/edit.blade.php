@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
        <form method="POST" action="{{ route('users.update', [Auth::user()->id]) }}" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
            <div class="card">
                <div class="card-header">ユーザー編集</div>

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

                            <div class="form-group mt-3" style="width: 15rem;">
                                <input type="file" class="form-control-file" name="icon">
                            </div>
                        </div>                        
                        <div class="col">
                            <label for="formGroupExampleInput2" class="form-label">ユーザー名</label>
                            <input type="text" class="form-control" placeholder="{{ Auth::user()->name }}" aria-label="name" name="name" value="{{ Auth::user()->name }}">
                        </div>     
                        </div>
                        
                        <div class="mb-3">
                            <label for="formGroupExampleInput2" class="form-label">メールアドレス</label>
                            <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="{{ Auth::user()->email }}" name="email" value="{{ Auth::user()->email }}">
                        </div>
                        <button type="submit" class="btn btn-primary">更新</button>
                    </div>
                </div>
            </div>
        </form>
        </div>
    </div>
</div>
@endsection
