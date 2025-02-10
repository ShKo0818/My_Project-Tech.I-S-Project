@extends('adminlte::page') 

@section('title', '商品編集')

@section('content_header')
    <h1>商品編集</h1>
@endsection

@section('content')
<form action="{{ route('item.update', $item->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PATCH')

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
// 商品名の入力欄を取得
const nameInput = document.getElementById('name');
const submitButton = document.getElementById('submitButton');

// 商品名を入力したときにチェックを実行
function checkNameLength() {
    const name = nameInput.value;
    const nameError = document.getElementById('nameError');
    const spaceError = document.getElementById('spaceError');

    // 半角スペースと全角スペースの両方をチェック
    const spacePattern = /[\s\u3000]/;  // 半角または全角スペースを含むかどうかの正規表現

    // スペースが含まれているか確認
    if (spacePattern.test(name)) {
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
    }

    // 商品名が変更されて、スペースが含まれていない場合、ボタンを有効化
    if (name.length <= 30 && !spacePattern.test(name)) {
        submitButton.disabled = false; // 商品名にスペースが含まれていなければボタンを有効化
    } else {
        submitButton.disabled = true;
    }

    checkPrice(); // 価格の確認も実行
}

// 価格が999,999円以上でないかチェック
function checkPrice() {
    const price = document.getElementById('price').value;
    const priceError = document.getElementById('priceError');

    if (price >= 1000000) {
        priceError.style.display = 'block';
        submitButton.disabled = true; // ボタンを無効化
    } else {
        priceError.style.display = 'none';
    }

    // 商品名の長さも再確認
    const name = nameInput.value;
    if (name.length <= 30 && price < 1000000 && !/[\s\u3000]/.test(name)) {
        submitButton.disabled = false; // 両方の条件を満たせばボタンを有効化
    }
}
</script>
