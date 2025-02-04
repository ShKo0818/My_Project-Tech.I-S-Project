@extends('adminlte::page')

@section('title', '商品編集')

@section('content_header')
    <h1>商品編集</h1>
@endsection

@section('content')
<form action="{{ route('item.update', $item->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PATCH')  <!-- 'PUT' を 'PATCH' に変更 -->

    <div class="form-group">
        <label for="name">商品名</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ $item->name }}" required>
    </div>

    <div class="form-group">
        <label for="price">価格</label>
        <input type="number" class="form-control" id="price" name="price" value="{{ $item->price }}" required min="0">
    </div>

    <div class="form-group">
        <label for="category">カテゴリ</label>
        <select class="form-control" id="category" name="category_id" required>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" @if($item->category_id == $category->id) selected @endif>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="image">商品画像</label>
        <div>
            <!-- 現在の画像を表示（エラー回避のためコメントアウト） -->
            <!--
            @if($item->image)
                <img src="{{ asset('storage/' . $item->image) }}" alt="商品画像" width="150">
            @else
                <span>画像はありません</span>
            @endif
            -->
        </div>
        <input type="file" class="form-control" id="image" name="image">
    </div>

    <button type="submit" class="btn btn-success">更新する</button>
</form>
@endsection
