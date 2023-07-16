@extends('layouts.app')
@section('title', '管理ユーザー一覧')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">ユーザー一覧</div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                <th scope="col">アイコン</th>
                                <th scope="col">ユーザー名</th>
                                <th scope="col">メールアドレス</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{$user->icon}}</td>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->email}}</td>
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
