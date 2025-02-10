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
        <input type="text" class="form-control" id="name" name="name" value="{{ $item->name }}" required oninput="checkForm()">
        <small id="nameError" class="text-danger" style="display:none;">商品名は30文字以内で入力してください</small>
        <small id="spaceError" class="text-danger" style="display:none;">商品名にスペースは含めないでください</small>
    </div>

    <div class="form-group">
        <label for="price">価格</label>
        <input type="number" class="form-control" id="price" name="price" value="{{ $item->price }}" required min="0" oninput="checkForm()">
        <small id="priceError" class="text-danger" style="display:none;">価格は999,999円以内で入力してください</small>
    </div>

    <!-- <div class="form-group">
        <label for="category">カテゴリ</label>
        <select class="form-control" id="category" name="category_id" required>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" @if($item->category_id == $category->id) selected @endif>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
    </div> -->

    <button type="submit" class="btn btn-success" id="submitButton" disabled>更新する</button>
</form>
@endsection

@section('js')
<script>
// サーバー側の元の商品名を取得（JSONエンコードして安全に出力）
const originalName = @json($item->name);

function checkForm() {
    const name = document.getElementById('name').value;
    const price = parseFloat(document.getElementById('price').value);
    const submitButton = document.getElementById('submitButton');
    const nameError = document.getElementById('nameError');
    const spaceError = document.getElementById('spaceError');
    const priceError = document.getElementById('priceError');
    // 正規表現：半角スペースおよび全角スペースを検出
    const spacePattern = /[\s\u3000]/;  

    let valid = true;
    
    // 商品名にスペースが含まれているかチェック
    if (spacePattern.test(name)) {
        spaceError.style.display = 'block';
        valid = false;
    } else {
        spaceError.style.display = 'none';
    }
    
    // 商品名の長さが30文字以内かチェック
    if (name.length > 30) {
        nameError.style.display = 'block';
        valid = false;
    } else {
        nameError.style.display = 'none';
    }
    
    // 価格が999,999円未満かチェック
    if (price >= 1000000) {
        priceError.style.display = 'block';
        valid = false;
    } else {
        priceError.style.display = 'none';
    }
    
    // 商品名が元の値と同じ場合は更新しない（変更がないので無効）
    if (name === originalName) {
        valid = false;
    }
    
    // 条件をすべて満たす場合のみ更新ボタンを有効化
    submitButton.disabled = !valid;
}

// 初期状態でもチェックを実行（画面読み込み後にボタンを無効化するため）
checkForm();
</script>

@endsection
