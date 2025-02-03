<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LoginCorpController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CartController;

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// 商品関連のルート
Route::middleware('auth')->group(function () {
    Route::prefix('item')->group(function () {
        // 商品一覧
        Route::get('/', [ItemController::class, 'index'])->name('item.index');

        // 商品登録
        Route::get('add', [ItemController::class, 'create'])->name('item.create');
        Route::post('add', [ItemController::class, 'store'])->name('item.add');
        Route::post('/item/store', [ItemController::class, 'store'])->name('item.store');

        // 買い物カート
        Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
        Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
        Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
        Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');
        Route::get('/cart/orderComplete', [CartController::class, 'orderComplete'])->name('cart.orderComplete');
        Route::get('/products', [ItemController::class, 'index'])->name('products.index');


        
        // 注文確認
        Route::get('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
        Route::post('/cart/confirm', [CartController::class, 'confirm'])->name('cart.confirm');
        Route::post('/cart/placeOrder', [CartController::class, 'placeOrder'])->name('cart.placeOrder');

        // 商品編集
        Route::get('{item}/edit', [ItemController::class, 'edit'])->name('item.edit'); // 商品編集ページ
        Route::patch('{item}', [ItemController::class, 'update'])->name('item.update'); // 商品更新処理

        // 商品削除ルート
        Route::delete('{item}', [ItemController::class, 'destroy'])->name('item.destroy');

        // 商品詳細表示
        Route::get('show/{id}', [ItemController::class, 'show'])->name('item.show');
    });

    // 商品発注（認可機能を追加）
    Route::prefix('order')->group(function () {
        Route::get('create', [OrderController::class, 'create'])->name('order.create');
        Route::post('store', [OrderController::class, 'store'])->name('order.store');
        Route::get('confirm', [OrderController::class, 'confirm'])->name('order.confirm');
        Route::post('final', [OrderController::class, 'finalStore'])->name('order.finalStore');
    });

    // ニュースページ
    Route::get('/news', function () {
        return view('news');
    })->name('news');

    // 法人用ダッシュボード
    Route::get('/home-corp', function () {
        return view('home-corp');
    })->name('home-corp');
});

// 一般ユーザーのログイン
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login'])->name('login.submit');

// 法人ログインページのルート
Route::get('login-corp', [LoginCorpController::class, 'showLoginForm'])->name('login.corp');
Route::post('login-corp', [LoginCorpController::class, 'login'])->name('login.corp.submit');

// Authルート（registerを無効にする場合）
Auth::routes(['register' => true]);
