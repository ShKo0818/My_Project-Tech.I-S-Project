@extends('adminlte::page')

@section('title', '商品一覧')

@section('content_header')
    <h1>商品一覧</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">商品一覧</h3>

                    <!-- 商品検索フォーム -->
                    <form action="{{ route('item.index') }}" method="GET" class="mb-3">
                        <div class="input-group">
                            <input type="text" name="keyword" class="form-control" placeholder="商品名を入力">
                            <select name="match" class="form-select">
                                <option value="partial">あいまい検索</option>
                                <option value="exact">完全一致</option>
                            </select>
                            <button type="submit" class="btn btn-primary">検索</button>
                        </div>
                    </form>
                </div>

                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>名前</th>
                                <th>種別</th>
                                <th>詳細</th>
                                <th>画像</th>
                                <th>価格</th> <!-- 価格の列を追加 -->
                                <th>メーカー名</th>
                                <th>操作</th> <!-- 編集・削除の列を追加 -->
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td><a href="{{ route('item.show', $item->id) }}">{{ $item->name }}</a></td>
                                    <td>{{ $item->category }}</td>
                                    <td>{{ $item->detail }}</td>
                                    <td>@if ($item->image)
                                        <img src="{{ asset('storage/' . $item->image) }}" alt="商品画像" class="img-fluid" style="max-width: 200px;">
                                        @else
                                        <p>画像がありません</p>
                                       @endif
                                    </td> <!-- 大きな画像表示 -->
                                    <td>
                                        @if ($item->price)
                                            ¥{{ number_format($item->price) }} <!-- 価格表示 -->
                                        @else
                                            価格未設定
                                        @endif
                                    </td>
                                    <td>{{ $item->company_name }}</td>

                                    <td>
                                        <form action="{{ route('cart.add') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="item_id" value="{{ $item->id }}">
                                            <input type="hidden" name="name" value="{{ $item->name }}">
                                            <input type="hidden" name="price" value="{{ $item->price }}">
                                            <input type="hidden" name="image" value="{{ asset('storage/' . $item->image) }}">

                                            <input type="number" name="quantity" value="1" min="1" class="form-control" style="width: 60px; display:inline;">
                                            <button type="submit" class="btn btn-sm btn-success">カートに追加</button>
                                        </form>
                                    </td>
                                    <td>
                                        @php
                                            $userType = auth()->user()->user_type; // ユーザーの種類を取得
                                            $isOwner = auth()->user()->company_id === $item->company_id; // 法人ユーザーの場合、自社商品かどうか判定
                                        @endphp

                                        @if ($userType === 'master' || ($userType === 'corporate' && $isOwner))
                                            <!-- 編集ボタン -->
                                            <a href="{{ route('item.edit', $item->id) }}" class="btn btn-sm btn-primary">編集</a>

                                            <!-- 削除ボタン -->
                                            <form action="{{ route('item.destroy', $item->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('本当に削除しますか？');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">削除</button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
@stop

@section('css')
@stop

@section('js')
@stop
