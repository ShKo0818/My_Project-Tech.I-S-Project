<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest');
    }

    public function validator(array $data)
{
    $rules = [
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'user_type' => ['required', 'in:general,corporate,master'],
        'password' => ['required', 'string', 'min:8', 'confirmed'],
    ];

        // 法人またはマスターの場合、会社名と社員番号が必須
        if ($data['user_type'] === 'corporate') {
            $rules['company_name'] = ['required', 'string', 'max:255'];
            $rules['membership_number'] = ['required', 'digits:4', 'numeric'];
        }
    
        if ($data['user_type'] === 'master') {
            $rules['company_name'] = ['required', 'string', 'max:255'];
            $rules['membership_number'] = ['required', 'digits:6', 'numeric'];
        }

    // 個人ユーザーの場合、company_name と membership_number のチェックは不要
    if ($data['user_type'] === 'general') {
        $rules['company_name'] = 'nullable';  // 個人ユーザーには不要
        $rules['membership_number'] = 'nullable'; // 個人ユーザーには不要
    }



    return Validator::make($data, $rules);
}

protected function create(array $data)
{
    // マスターが選択された場合は会社名を自動設定
    if ($data['user_type'] === 'master') {
        $data['company_name'] = 'マスター（株）';
    }

    return User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password']),
        'company_name' => $data['company_name'] ?? null, // 法人やマスターのユーザーに会社名を保存
        'membership_number' => $data['membership_number'], 
        'user_type' => $data['user_type'],
    ]);
}
}
