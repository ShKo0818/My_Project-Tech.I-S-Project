@extends('adminlte::page')

@section('title', '買い物カゴ')

@section('content_header')
    <h1>買い物カゴ</h1>
@stop

@section('content')
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>商品名</th>
                <th>価格</th>
                <th>数量</th>
                <th>小計</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
            @php $total = 0; @endphp
            @foreach ($cart as $id => $item)
                @php $subtotal = $item['price'] * $item['quantity']; @endphp
                <tr>
                    <!-- 画像が存在する場合に表示
                    <td>
                        @if(isset($item['image']))
                            <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}" width="50">
                        @else
                            <span>画像なし</span>
                        @endif
                    </td> -->
                    <td>{{ $item['name'] }}</td>
                    <td>¥{{ number_format($item['price']) }}</td>
                    <td>{{ $item['quantity'] }}</td>
                    <td>¥{{ number_format($subtotal) }}</td>
                    <td>
                        <form action="{{ route('cart.remove') }}" method="POST">
                            @csrf
                            <input type="hidden" name="item_id" value="{{ $id }}">
                            <button type="submit" class="btn btn-danger btn-sm">削除</button>
                        </form>
                    </td>
                </tr>
                @php $total += $subtotal; @endphp
            @endforeach
        </tbody>
    </table>

    <h3>合計: ¥{{ number_format($total) }}</h3>

    <form action="{{ route('cart.clear') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-warning">カートを空にする</button>
    </form>

    <a href="{{ route('cart.checkout') }}" class="btn btn-primary mt-3">購入手続きへ</a>


@stop
