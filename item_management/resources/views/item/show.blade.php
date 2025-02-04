@extends('adminlte::page')

@section('title', '商品詳細')

@section('content_header')
    <h1>商品詳細</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h3>{{ $item->name }}</h3>
                    <p><strong>種別:</strong> {{ $item->type }}</p>
                    <p><strong>詳細:</strong> {{ $item->detail }}</p>
                    <p><strong>メーカー名:</strong> {{ $item->company_name }}</p>
                    <p><strong>商品カテゴリ:</strong> {{ $item->category }}</p>
                
                    <form action="{{ route('cart.add') }}" method="POST">
                    @csrf
                    <input type="hidden" name="item_id" value="{{ $item->id }}">
                    <input type="hidden" name="name" value="{{ $item->name }}">
                    <input type="hidden" name="price" value="{{ $item->price }}">
                    <input type="hidden" name="image" value="{{ asset('storage/' . $item->image) }}">

                    <label for="quantity">数量：</label>
                    <input type="number" name="quantity" value="1" min="1" class="form-control" style="width: 60px; display:inline;">
                    <button type="submit" class="btn btn-success">カートに追加</button>
                </form>

                <!-- 画像表示処理（エラーを吐かないようにコメントアウト） -->
                <!--
                @if($item->image)
                    <img src="{{ asset('storage/' . $item->image) }}" alt="Product Image" style="max-width: 50%; height: auto;">
                @else
                    <p>画像がありません</p>
                @endif
                -->
                
                </p>

                
                </div>
            </div>
        </div>
    </div>
@stop
