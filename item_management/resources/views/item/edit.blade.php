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
        <input type="text" class="form-control" id="name" name="name" value="{{ $item->name }}" required oninput="checkNameLength()">
        <small id="nameError" class="text-danger" style="display:none;">商品名は30文字以内で入力してください</small>
        <small id="spaceError" class="text-danger" style="display:none;">商品名にスペースは含めないでください</small>
    </div>

    <div class="form-group">
        <label for="price">価格</label>
        <input type="number" class="form-control" id="price" name="price" value="{{ $item->price }}" required min="0" oninput="checkPrice()">
        <small id="priceError" class="text-danger" style="display:none;">価格は999,999円以内で入力してください</small>
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

    <button type="submit" class="btn btn-success" id="submitButton" disabled>更新する</button>
</form>
@endsection

<script>
// 商品名が30文字を超えていないかチェック
function checkNameLength() {
    const name = document.getElementById('name').value;
    const nameError = document.getElementById('nameError');
    const spaceError = document.getElementById('spaceError');
    const submitButton = document.getElementById('submitButton');

    // スペースが含まれているか確認
    if (name.includes(' ')) {
        spaceError.style.display = 'block';
        submitButton.disabled = true; // ボタンを無効化
    } else {
        spaceError.style.display = 'none';
    }

    // 商品名が30文字を超えていないかチェック
    if (name.length > 30) {
        nameError.style.display = 'block';
        submitButton.disabled = true; // ボタンを無効化
    } else {
        nameError.style.display = 'none';
        checkPrice(); // 価格の確認も実行
    }
}

// 価格が999,999円以上でないかチェック
function checkPrice() {
    const price = document.getElementById('price').value;
    const priceError = document.getElementById('priceError');
    const submitButton = document.getElementById('submitButton');

    if (price >= 1000000) {
        priceError.style.display = 'block';
        submitButton.disabled = true; // ボタンを無効化
    } else {
        priceError.style.display = 'none';
    }

    // 商品名の長さも再確認
    const name = document.getElementById('name').value;
    if (name.length <= 30 && price < 1000000) {
        submitButton.disabled = false; // 両方の条件を満たせばボタンを有効化
    }
}
</script>
