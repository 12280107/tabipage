@extends('layouts.app')
@section('title', '違反報告の多い投稿一覧')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">違反報告一覧</div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                <th scope="col">タイトル</th>
                                <th scope="col">ユーザー名</th>
                                <th scope="col">違反報告数</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($posts as $post)
                                    <tr>
                                        <td>{{$post->icon}}</td>
                                        <td>{{$post->name}}</td>
                                        <td>{{$post->violation}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
