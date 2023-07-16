@extends('layouts.app')
@section('title', '管理者ページ')
@section('content')
    <h1>管理者ページ</h1>
        <div class="card-footer">
            <a href="{{ route('admin.users.index', ['admin_user' => 'admin']) }}" class="btn btn-primary">ユーザー一覧</a>
            <a href="{{ route('admin.posts.index', ['admin' => 'admin']) }}" class="btn btn-primary">投稿一覧</a>
        </div>
@endsection


    
