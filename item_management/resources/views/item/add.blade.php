@extends('adminlte::page')

@section('title', '商品登録')

@section('content_header')
    <h1>商品登録</h1>
@stop

@section('content')
    <div class="row"> 
        <div class="col-md-10">
            @if ($errors->any()) 
                <div class="alert alert-danger">
                    <ul>
                       @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                       @endforeach
                    </ul>
                </div>
            @endif

            <div class="card card-primary">
                <form method="POST" action="{{ route('item.store') }}" enctype="multipart/form-data" id="itemForm">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">名前</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="名前" required maxlength="30" oninput="checkNameLength()">
                            <small id="nameError" class="text-danger" style="display:none;">商品名は30文字以内で入力してください。</small>
                        </div>

                        <div class="form-group">
                            <label for="category">カテゴリ</label>
                            <select name="category" id="category" class="form-control" >
                                <option value="">選択してください</option>
                                <option value="野菜" {{ old('category') == '野菜' ? 'selected' : '' }}>野菜</option>
                                <option value="フルーツ" {{ old('category') == 'フルーツ' ? 'selected' : '' }}>フルーツ</option>
                                <option value="花" {{ old('category') == '花' ? 'selected' : '' }}>花</option>
                                <option value="その他観葉植物" {{ old('category') == 'その他観葉植物' ? 'selected' : '' }}>その他観葉植物</option>
                                <option value="農業用品" {{ old('category') == '農業用品' ? 'selected' : '' }}>農業用品</option>
                                <option value="園芸用品" {{ old('category') == '園芸用品' ? 'selected' : '' }}>園芸用品</option>
                                <option value="その他" {{ old('category') == 'その他' ? 'selected' : '' }}>その他</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="detail">詳細</label>
                            <input type="text" class="form-control" id="detail" name="detail" placeholder="詳細説明" maxlength="2000" oninput="checkDetailLength()">
                            <small id="detailError" class="text-danger" style="display:none;">詳細は2000文字以内で入力してください。</small>
                        </div>

                        <div class="form-group">
                            <label for="company_name">メーカー名</label>
                            <input type="text" class="form-control" id="company_name" name="company_name" 
                            @if(Auth::user()->user_type === 'corporate')
                                value="{{ Auth::user()->company_name }}" readonly
                            @else
                                placeholder="メーカー名を入力" maxlength="30" oninput="checkCompanyNameLength()"
                            @endif>
                            <small id="companyNameError" class="text-danger" style="display:none;">メーカー名は30文字以内で入力してください。</small>
                        </div>

                        <div class="form-group">
                            <label for="price">価格</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">￥</span>
                                </div>
                                <input type="number" class="form-control" id="price" name="price" placeholder="価格を入力" required min="1">
                            </div>
                        </div>

                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" id="submitButton">登録</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // 商品名が30文字を超えていないかチェック
        function checkNameLength() {
            const name = document.getElementById('name').value;
            const nameError = document.getElementById('nameError');
            const submitButton = document.getElementById('submitButton');
            
            if (name.length > 30) {
                nameError.style.display = 'block';
                submitButton.disabled = true; // ボタンを無効化
            } else {
                nameError.style.display = 'none';
                submitButton.disabled = false; // ボタンを有効化
            }
        }

        // 詳細が2000文字を超えていないかチェック
        function checkDetailLength() {
            const detail = document.getElementById('detail').value;
            const detailError = document.getElementById('detailError');
            const submitButton = document.getElementById('submitButton');
            
            if (detail.length > 100) {
                detailError.style.display = 'block';
                submitButton.disabled = true; // ボタンを無効化
            } else {
                detailError.style.display = 'none';
                submitButton.disabled = false; // ボタンを有効化
            }
        }

        // メーカー名が30文字を超えていないかチェック
        function checkCompanyNameLength() {
            const companyName = document.getElementById('company_name').value;
            const companyNameError = document.getElementById('companyNameError');
            const submitButton = document.getElementById('submitButton');
            
            if (companyName.length > 30) {
                companyNameError.style.display = 'block';
                submitButton.disabled = true; // ボタンを無効化
            } else {
                companyNameError.style.display = 'none';
                submitButton.disabled = false; // ボタンを有効化
            }
        }
    </script>
@stop
