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
                    <div class="row g-3">
                        <div class="col">
                            <label for="formGroupExampleInput2" class="form-label">アイコン</label>
                            <input type="text" class="form-control" placeholder="First name" aria-label="First name">
                        </div>
                        <div class="col">
                            <label for="formGroupExampleInput2" class="form-label">ユーザー名</label>
                            <input type="text" class="form-control" placeholder="Last name" aria-label="Last name">
                        </div>
                        </div>                        
                        <div class="mb-3">
                            <label for="formGroupExampleInput2" class="form-label">メールアドレス</label>
                            <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="Another input placeholder">
                        </div>
                        <div class="mb-3">
                            <label for="formGroupExampleInput" class="form-label">パスワード</label>
                            <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Example input placeholder">
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
