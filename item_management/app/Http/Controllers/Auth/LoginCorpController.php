<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginCorpController extends Controller
{
    /**
     * Show the form for logging in to the corporate account.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('auth.login-corp'); // ログインフォームを表示
    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
{
    // バリデーションルールを定義
    $rules = [
        'email' => 'required|email',
        'password' => 'required|string',
        'membership_number' => 'required|numeric', // 一旦数値のみ必須とする
    ];

    // 一時的にバリデーション
    $validated = $request->validate($rules);

    // 入力された認証情報を取得
    $credentials = $request->only('email', 'password', 'membership_number');

    // 認証試行
    if (Auth::attempt($credentials)) {
        $user = Auth::user();

        // ユーザーの種類ごとに企業番号の桁数を確認
        if ($user->user_type === 'corporate' && strlen($request->membership_number) !== 4) {
            Auth::logout();
            return redirect()->route('login.corp')->withErrors([
                'membership_number' => '法人ユーザーの企業番号は4桁である必要があります。',
            ]);
        }

        if ($user->user_type === 'master' && strlen($request->membership_number) !== 6) {
            Auth::logout();
            return redirect()->route('login.corp')->withErrors([
                'membership_number' => 'マスターユーザーの企業番号は6桁である必要があります。',
            ]);
        }

        // 法人ユーザーまたはマスターユーザーの場合
        return redirect()->route('home-corp'); // 法人のダッシュボード
    }

    // 認証失敗時のエラーメッセージ
    return redirect()->route('login.corp')->withErrors([
        'email' => '適切なメールアドレス、パスワード、会員番号を入力してください。',
    ]);
}

}
