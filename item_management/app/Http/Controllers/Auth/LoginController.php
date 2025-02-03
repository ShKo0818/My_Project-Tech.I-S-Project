<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        // バリデーション
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // 入力された認証情報を取得
        $credentials = $request->only('email', 'password');

        // 認証試行
        if (Auth::attempt($credentials)) {
            // 認証成功
            $user = Auth::user();

            // 一般ログイン画面からのアクセスを制限
            if ($request->is('login') && $user->user_type === 'corporate') {
                Auth::logout(); // ログアウト
                return redirect()->route('login')->withErrors([
                    'email' => '法人ユーザーは法人ログイン画面からログインしてください。',
                ]);
            }

            // ユーザータイプに応じてリダイレクト
            if ($user->user_type === 'general') {
                return redirect()->route('home'); // 一般ユーザーのホームページ
            } elseif ($user->user_type === 'corporate') {
                return redirect()->route('home-corp'); // 法人ユーザーのホームページ
            } elseif ($user->user_type === 'master') {
                return redirect()->route('home-corp'); // マスターユーザーのホームページ
            }
        }

        // 認証失敗時
        return redirect()->route('login')->withErrors([
            'email' => '適切なメールアドレス、パスワードを入力してください。',
        ]);
    }
}
