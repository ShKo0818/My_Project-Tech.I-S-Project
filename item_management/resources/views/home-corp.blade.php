@extends('adminlte::page')

@section('title', 'テックフルーツ　ホーム')

@section('content_header')
    <h1>テックフルーツへようこそ {{ Auth::user()->name }} さん　 会員データ：({{ ucfirst(Auth::user()->user_type) }})</h1>
    <div class="title">
        <!-- 他の内容があればここに追加 -->

        <div>(自主制作ページです 卸売会社の管理ページを想定しています）</div>
    </div>
@stop


@section('content')
    <p>商品管理システムへようこそ</p>
    <p>最終更新</p>
        <section class="news">
            <div class= "inner">
                <h2 class= "sub-title">NEWS</h2>
            <!-- ここからニュース記事 -->
            <iframe src="{{ route('news') }}" width="600" height="150">
    インラインフレーム対応ブラウザでご覧いただけます。
</iframe>

             <ul class="news_list">
                <li class="news_list_item">
                    <a href=""></a>
                     <div class="news_list_date">
                        <time><script type="text/javascript"><!--
                            document.write('最終更新日:' + document.lastModified);
                                // --></script></time>
                        <p class="news_item">おしらせ</p>
                     </div>
                     <p>サイトリニューアルしました</p>
                     <button type="button" class="btn btn-primary">Primary</button>
                     <span class="arrow"></span>
                    </a> 
                </li>

             </ul>

            </div>
            
        </div>

@stop

@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
