@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('法人ログイン') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login.corp') }}">
                        @csrf

                        <!-- メールアドレス -->
                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('メールアドレス') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- パスワード -->
                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('パスワード') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- 企業番号 -->
                        <div class="row mb-3">
                            <label for="membership_number" class="col-md-4 col-form-label text-md-end">{{ __('企業番号') }}</label>

                            <div class="col-md-6">
                                <input id="membership_number" type="text" class="form-control @error('membership_number') is-invalid @enderror" name="membership_number" value="{{ old('membership_number') }}" required>

                                @error('membership_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- パスワードを保存するチェックボックス -->
                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('パスワードを保存する') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- ログインボタン -->
                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>
                            </div>
                        </div>

                        <!-- パスワードリセットリンク -->
                        @if (Route::has('password.request'))
                                    <a class="col-md-8 offset-md-4" href="{{ route('password.request') }}">
                                        {{ __('パスワードをお忘れですか？') }}
                                    </a>
                                @endif

                        <!-- 一般ユーザーリンク -->
                        <div class="col-md-6 offset-md-5">
                            <a class="common-user-link" href="{{ route('login') }}">
                                一般ユーザーの方はこちら
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
