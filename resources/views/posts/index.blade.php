@extends('layouts.app')
@section('title', '投稿一覧')
@section('content')
<div class="search">
    <form action="{{ route('posts.index') }}" method="GET">
        @csrf
        <div class="container">

        <div class="form-group">
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <label for="query">キーワード</label>
                    <input type="text" name="query" id="query" value="@if (isset($query)) {{ $query }} @endif">
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-3">
                    <label for="date_start">開始日</label>
                    <input type="date" name="date_start" id="date_start" value="@if (isset($date_start)) {{ $date_start }} @endif">
                </div>
                <div class="col-md-3">
                    <label for="date_fin">終了日</label>
                    <input type="date" name="date_fin" id="date_fin" value="@if (isset($date_fin)) {{ $date_fin }} @endif">
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row justify-content-center">
                <div class="col-md-3">
                    <label for="amount_start">最低金額</label>
                    <input type="number" name="amount_start" id="amount_start" value="@if (isset($amount_start)) {{ $amount_start}} @endif">
                </div>
                <div class="col-md-3">
                    <label for="amount_fin">最高金額</label>
                    <input type="number" name="amount_fin" id="amount_fin" value="@if (isset($amount_fin)) {{ $amount_fin}} @endif">
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-1">
                    <button type="submit">検索</button>
                </div>
            </div>
        </div>
</div>
    </form>
</div>        
<div class="container">
    <input type="hidden" id="count" value=0>
    <div id="content" class="row justify-content-start">
        @foreach ($posts as $post)
        <div class="col-md-4">
            <div class="card" style="width: 18rem;">
                <img src="{{'storage/'.$post->image }}" class="card-img-top" alt="..." style="object-fit:cover; width: 100%; height: 15rem;">
                <div class="card-body">
                    <h2><a href="{{ route('posts.show', ['id' => $post->id]) }}">{{ $post->title }}</a></h2>
                    <p class="card-text">宿泊可能日</p>
                    <p class="card-text">{{ $post->date_start }}~{{ $post->date_fin }}</p>
                    <p class="card-text">人数:{{ $post->number }}人</p>
                    <p class="card-text">金額:{{ $post->amount }}円</p>
                    <small>作成日:{{ $post->created_at }}</small>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
$(function(){
    var count = 0;
      // スクロールされた時に実行 
    $(window).on("scroll", function () {
    // スクロール位置
        var document_h = $(document).height();              
        var window_h = $(window).height() + $(window).scrollTop();    
        var scroll_pos = (document_h - window_h) / document_h ;   
            
        
        // 画面最下部にスクロールされている場合
        if (scroll_pos <= 10) {
            console.log(scroll_pos);
            // ajaxコンテンツ追加処理
            ajaxAddContent()
        }
    });
   
  // ajaxコンテンツ追加処理
    function ajaxAddContent() {
      // 追加コンテンツ
      var add_content = "";
      // コンテンツ件数           
      count = count + 1;
      var query = $("#query").val();
      var date_start = $("#date_start").val();
      var date_fin= $("#date_fin").val();
      var amount_start= $("#amount_start").val();
      var amount_fin= $("#amount_fin").val();
       
      // ajax処理
      $.post({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        },
          type: "post",
          datatype: "json",
          url: "/posts/more",
          data:{ count : count ,query: query, date_start : date_start , date_fin : date_fin, amount_start : amount_start, amount_fin : amount_fin }
      }).done(function(data){
          // コンテンツ生成
          console.log(data);
          $.each(data[1],function(key, val){
              add_content += 
              `<div class="col-4 mb-4">
                <div class="card" style="width: 18rem;">
                    <img src="storage/${val.image}" style="object-fit:cover; width: 100%; height: 15rem;" class="card-img-top" alt="">
                    <div class="card-body">
                        <h2><a href="/posts/${val.id}">${val.title}</a></h2>
                        <p class="card-text">宿泊可能日</p>
                        <p class="card-text">${val.date_start}~${val.date_fin}</p>
                        <p class="card-text">人数:${val.number}人</p>
                        <p class="card-text">金額:${val.amount}円</p>
                        <small>作成日:${val.created_at}</small>
                    </div>
                </div>
            </div>`;
          })

          // コンテンツ追加
          $("#content").append(add_content);
          $("#count").val(count);
      }).fail(function(e){
          console.log(e);
      })
    }
  
});
</script>