@extends('adminlte::page')

@section('title', '注文確認')

@section('content_header')
    <h1>注文確認</h1>
@stop

@section('content')
    <p>ご注文内容を確認の上、「注文します」ボタンを押して、注文を完了してください。</p>

    <h4>お名前: {{ $name }}</h4>
    <h4>ご住所: {{ $address }}</h4>
    <h4>電話番号: {{ $phone }}</h4>

    <form action="{{ route('cart.placeOrder') }}" method="POST">
        @csrf

        <button type="submit" class="btn btn-success">注文します</button>
        <a href="{{ route('cart.checkout') }}" class="btn btn-danger">戻る</a>
    </form>
@stop
