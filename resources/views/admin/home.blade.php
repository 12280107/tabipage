@extends('layouts.app')
@section('title', '管理画面')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
                <a herf ="{{route('admin.users')}}" class="btn btn-primary">ユーザー一覧</a>
        </div>
        <div class="col-md-6">
                <a herf ="{{route('admin.posts')}}" class="btn btn-primary">違反報告一覧</a>
        </div>

    </div>
</div>
@endsection
