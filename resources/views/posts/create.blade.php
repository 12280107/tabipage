@extends('layouts.app')
@section('title','新規投稿')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form method="post" action="{{ route('posts.store') }}">
                @csrf
                <div class="mb-3">
                    <label for="exampleInputTitle" class="form-label">タイトル</label>
                    <input type="text" class="form-control" id="exampleInputTitle" aria-describedby="" name="title">
                </div>

                <div class="mb-3">
                    <div class="row">
                        <div class="col">
                            <label for="exampleInputDate1" class="form-label">宿泊開始日</label>
                            <input type="date" class="form-control" id="exampleInputDate1" name="date_start">
                        </div>
                        <div class="col">
                            <label for="exampleInputDate2" class="form-label">宿泊終了日</label>
                            <input type="date" class="form-control" id="exampleInputDate2" name="date_fin">
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <div class="row">
                        <div class="col">
                            <label for="exampleInputNumber" class="form-label">宿泊可能人数</label>
                            <input type="text" class="form-control" id="exampleInpuNumber" name="number">
                        </div>
                        <div class="col">
                            <label for="exampleInputAmount" class="form-label">金額</label>
                            <input type="text" class="form-control" id="exampleInpuAmount" name="amount">
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="exampleInputTitle" class="form-label">住所</label>
                    <input type="text" class="form-control" id="exampleInputaddress" aria-describedby="" name="address">
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="exampleInputImage" class="form-label">画像</label>
                            <input type="text" class="form-control" id="exampleInputImage" name="image">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="exampleInputContent" class="form-label">内容</label>
                            <textarea type="text" class="form-control" id="exampleInputContent" name="content"></textarea>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">投稿する</button>
            </form>
        </div>
    </div>
</div>
@endsection
