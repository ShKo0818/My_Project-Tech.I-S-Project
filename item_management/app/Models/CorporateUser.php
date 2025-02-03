<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CorporateUser extends Model
{
    use HasFactory;

    protected $fillable = ['email', 'password', 'corporation_number'];
}

// ログインコントローラー
public function login(Request $request)
{
    // バリデーション
    $validated = $request->validate([
        'email' => 'required|email',
        'password' => 'required|string',
        'corporation_number' => 'required|numeric|digits:10', // 法人ユーザーのときのみ企業番号を要求
    ]);

    // 法人ユーザーを取得
    $corporateUser = CorporateUser::where('email', $request->email)->first();

    if ($corporateUser && $corporateUser->corporation_number == $request->corporation_number && Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
        return redirect()->intended(route('dashboard'));
    }

    // 認証失敗
    return back()->withErrors(['email' => '認証に失敗しました。']);
}
