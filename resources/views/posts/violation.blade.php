@extends('layouts.app')
@section('title','違反報告')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
        <form method="post" action="{{ route('posts.violation_store', ['id' => $post_id]) }}">
            @csrf
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="label">違反報告コメント</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="violation"></textarea>
                <input type="hidden" class="btn btn-primary">
                <input type="submit" value="報告する" >
            </div> 
        </form>       
        </div>
    </div>
</div>
@endsection
