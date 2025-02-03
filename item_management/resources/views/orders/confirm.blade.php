@extends('adminlte::page')

@section('title', '発注確認')

@section('content_header')
    <h1>発注確認</h1>
@endsection

@section('content')
    <h4>以下の内容で発注してよろしいですか？</h4>

    <div class="form-group">
        <label>商品名</label>
        <p>{{ $order['item_name'] }}</p>
    </div>

    <div class="form-group">
        <label>発注数</label>
        <p>{{ $order['quantity'] }}</p>
    </div>

    <div class="form-group">
        <label>金額</label>
        <p>{{ $order['price'] }}</p>
    </div>

    <div class="form-group">
        <label>カテゴリ</label>
        <p>{{ $order['category'] }}</p>
    </div>

    <div class="form-group">
        <label>メーカー名</label>
        <p>{{ $order['company_name'] }}</p>
    </div>

    <!-- 発注確認ボタン -->
    <form action="{{ route('order.finalStore') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-success">はい、発注します</button>
    </form>

    <!-- 発注中止ボタン -->
    <form action="{{ route('order.create') }}" method="GET">
        <button type="submit" class="btn btn-danger">いいえ、戻ります</button>
    </form>
@endsection
