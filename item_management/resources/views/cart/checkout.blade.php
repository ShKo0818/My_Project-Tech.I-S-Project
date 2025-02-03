@extends('adminlte::page')

@section('title', '購入手続き')

@section('content_header')
    <h1>購入手続き</h1>
@stop

@section('content')
    <p>こちらのページで必要情報をご記入のうえ、注文手続きを進めてください。</p>

    <form action="{{ route('cart.confirm') }}" method="POST">
        @csrf

        <!-- 名前 -->
        <div class="form-group">
            <label for="name">お名前</label>
            <input type="text" id="name" name="name" class="form-control" required>
        </div>

        <!-- 住所 -->
        <div class="form-group">
            <label for="address">ご住所（都道府県、市町村、番地）</label>
            <input type="text" id="address" name="address" class="form-control" placeholder="例: 東京都渋谷区1-2-3" required>
        </div>

        <!-- 電話番号 -->
        <div class="form-group">
            <label for="phone">電話番号</label>
            <input type="text" id="phone" name="phone" class="form-control" required>
        </div>

        <!-- 注文確認ボタン -->
        <button type="submit" class="btn btn-primary">注文確認</button>
    </form>
@stop
