@extends('layouts.app')
@section('title', '管理ユーザー一覧')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    @if(auth()->user()->role === 3)
                        <form action="{{ route('stop_user_function') }}" method="post">
                            @csrf
                            <button type="submit" class="btn btn-primary">選択したユーザー機能停止</button>
                            <!-- ユーザー一覧を表示 -->
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">ユーザー名</th>
                                        <th scope="col">メールアドレス</th>
                                        <th scope="col">表示停止数</th>
                                        <th scope="col">選択</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($users as $user)
                                        @php
                                            // stop_flgが1の場合はクラス名とチェックボックスの表示を変更
                                            $stopClass = $user->stop_flg == 1 ? 'stopped-user' : '';
                                            // stop_flgが0の場合のみチェックボックスを表示
                                            $showCheckbox = auth()->user()->role === 3 && $user->stop_flg != 1;
                                        @endphp
                                        <tr class="{{ $stopClass }}">
                                            <td>{{$user->name}}</td>
                                            <td>{{$user->email}}</td>
                                            <td>{{$user->total_violation_count}}</td>
                                            <td>
                                                <!-- チェックボックスをフォーム内に配置 -->
                                                @if($showCheckbox)
                                                    <input type="checkbox" name="stop_flg[]" value="{{$user->id}}">
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection