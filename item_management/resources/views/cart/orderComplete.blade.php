@extends('adminlte::page')

@section('title', '注文完了')

@section('content_header')
    <h1>注文が完了しました</h1>
@stop

@section('content')
    <p>ご注文ありがとうございました。商品一覧ページに戻ります。</p>

    <a href="{{ route('products.index') }}" class="btn btn-primary">商品一覧ページへ戻る</a>
@stop
