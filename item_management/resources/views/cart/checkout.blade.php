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
            <input type="text" id="name" name="name" class="form-control" required oninput="checkForm()">
            <small id="nameError" class="text-danger" style="display:none;">名前は30文字以内で入力してください</small>
        </div>

        <!-- 住所 -->
        <div class="form-group">
            <label for="address">ご住所（都道府県、市町村、番地）</label>
            <input type="text" id="address" name="address" class="form-control" placeholder="例: 東京都渋谷区1-2-3" required oninput="checkForm()">
            <small id="addressError" class="text-danger" style="display:none;">住所は30文字以内で入力してください</small>
        </div>

        <!-- 電話番号 -->
        <div class="form-group">
            <label for="phone">電話番号</label>
            <input type="text" id="phone" name="phone" class="form-control" required oninput="checkForm()">
            <small id="phoneError" class="text-danger" style="display:none;">電話番号は10〜12桁の数字で入力してください</small>
        </div>

        <!-- 注文確認ボタン -->
        <button type="submit" class="btn btn-primary" id="submitButton" disabled>注文確認</button>
    </form>
@stop

<script>
// フォームの入力値をチェックしてボタンを無効化/有効化
function checkForm() {
    const name = document.getElementById('name').value;
    const address = document.getElementById('address').value;
    const phone = document.getElementById('phone').value;
    const submitButton = document.getElementById('submitButton');
    const nameError = document.getElementById('nameError');
    const addressError = document.getElementById('addressError');
    const phoneError = document.getElementById('phoneError');

    // 名前が30文字を超えていればエラー表示
    if (name.length > 30 || /\s/.test(name)) {
        nameError.style.display = 'block';
        submitButton.disabled = true;
    } else {
        nameError.style.display = 'none';
    }

    // 住所が30文字を超えていればエラー表示
    if (address.length > 30 || /\s/.test(address)) {
        addressError.style.display = 'block';
        submitButton.disabled = true;
    } else {
        addressError.style.display = 'none';
    }

    // 電話番号が10〜12桁の数字か、数字以外が含まれていればエラー表示
    const phoneRegex = /^\d{10,12}$/;
    if (!phoneRegex.test(phone)) {
        phoneError.style.display = 'block';
        submitButton.disabled = true;
    } else {
        phoneError.style.display = 'none';
    }

    // すべての入力が制限を満たしていればボタンを有効化
    if (name.length <= 30 && address.length <= 30 && phoneRegex.test(phone)) {
        submitButton.disabled = false;
    }
}
</script>
