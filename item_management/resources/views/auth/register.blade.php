@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('ユーザー登録') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <!-- 名前 -->
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('名前') }}</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('メールアドレス') }}</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- ユーザータイプ選択 -->
                        <div class="row mb-3">
                            <label for="user_type" class="col-md-4 col-form-label text-md-end">{{ __('ユーザータイプ') }}</label>
                            <div class="col-md-6">
                                <select id="user_type" class="form-control @error('user_type') is-invalid @enderror" name="user_type" required>
                                    <option value="general" {{ old('user_type') == 'general' ? 'selected' : '' }}>一般</option>
                                    <option value="corporate" {{ old('user_type') == 'corporate' ? 'selected' : '' }}>法人</option>
                                    <option value="master" {{ old('user_type') == 'master' ? 'selected' : '' }}>マスター</option>
                                </select>
                                @error('user_type')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- 会社名 -->
                        <div class="row mb-3" id="company_name_row">
                            <label for="company_name" class="col-md-4 col-form-label text-md-end">{{ __('会社名') }}</label>
                            <div class="col-md-6">
                                <input id="company_name" type="text" class="form-control @error('company_name') is-invalid @enderror" name="company_name" value="{{ old('company_name') }}" required>
                                @error('company_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ '企業名を入力してください' }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- 企業番号 -->
                        <div class="row mb-3" id="membership_number_row">
                            <label for="membership_number" class="col-md-4 col-form-label text-md-end">{{ __('企業番号') }}</label>
                            <div class="col-md-6">
                                <input id="membership_number" type="text" class="form-control @error('membership_number') is-invalid @enderror" name="membership_number" value="{{ old('membership_number') }}" maxlength="6">
                                @error('membership_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ '正しい番号を入力してください（法人４桁　マスター６桁' }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- パスワード -->
                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('パスワード') }}</label>
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ '正しいパスワードを入力してください（８文字以上）' }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- パスワード確認 -->
                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('パスワード確認') }}</label>
                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <!-- 登録ボタン -->
                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('登録') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const userTypeField = document.getElementById('user_type');
        const companyNameField = document.getElementById('company_name');
        const companyNameRow = document.getElementById('company_name_row');
        const membershipNumberRow = document.getElementById('membership_number_row');
        const membershipNumberField = document.getElementById('membership_number');

        function updateFormFields() {
            const userType = userTypeField.value;

            if (userType === 'corporate' || userType === 'master') {
                companyNameRow.style.display = 'flex';
                membershipNumberRow.style.display = 'flex';

                if (userType === 'master') {
                    companyNameField.value = 'マスター（株）';
                    companyNameField.readOnly = true;
                    membershipNumberField.maxLength = 6;  // マスターは6桁
                    companyNameField.required = false; // マスターは会社名不要
                    membershipNumberField.required = true; // マスターは企業番号必須
                } else {
                    companyNameField.value = '';
                    companyNameField.readOnly = false;
                    membershipNumberField.maxLength = 4;  // 法人は4桁
                    companyNameField.required = true; // 法人は会社名必須
                    membershipNumberField.required = true; // 法人は企業番号必須
                }
            } else {
                companyNameRow.style.display = 'none';
                membershipNumberRow.style.display = 'none';
                companyNameField.value = '';
                companyNameField.readOnly = false;
                companyNameField.required = false;
                membershipNumberField.value = '';
                membershipNumberField.required = false;
            }
        }

        userTypeField.addEventListener('change', updateFormFields);
        updateFormFields();
    });
</script>
@endsection
