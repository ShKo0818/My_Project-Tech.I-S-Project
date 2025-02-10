<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class CartController extends Controller
{
    /**
     * カートを表示
     */
    public function index()
    {
        $cart = session()->get('cart', []);
        $totalPrice = session()->get('cart_total', 0);

        return view('cart.index', compact('cart', 'totalPrice'));
    }

    /**
     * カートに商品を追加 (メソッド名を `add` に統一)
     */
    public function add(Request $request)
    {
        $id = $request->input('item_id'); // フォームから `item_id` を取得
        $item = Item::findOrFail($id);

        // セッションからカートを取得
        $cart = session()->get('cart', []);

        // 商品が既にカートにある場合、数量を増やす
        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            // 商品がカートにない場合、新しく追加
            $cart[$id] = [
                'name' => $item->name,
                'price' => $item->price ?? 0, // 価格が null の場合は 0 に
                'quantity' => 1,
                'image' => asset('storage/' . $item->image),  // 画像情報も追加
            ];
        }

        session()->put('cart', $cart);

        // カート合計金額の計算
        $totalPrice = array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cart));
        session()->put('cart_total', $totalPrice);

        return redirect()->route('cart.index')->with('success', '商品をカートに追加しました！');
    }

    /**
     * カート内の商品を削除
     */
    public function remove(Request $request)
    {
        $id = $request->input('item_id'); // フォームから `item_id` を取得
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        // カート合計金額を再計算
        $totalPrice = array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cart));
        session()->put('cart_total', $totalPrice);

        return redirect()->route('cart.index')->with('success', '商品をカートから削除しました！');
    }

    /**
     * カートを空にする
     */
    public function clear()
    {
        session()->forget('cart');
        session()->forget('cart_total');

        return redirect()->route('cart.index')->with('success', 'カートを空にしました！');
    }

    /**
     * 購入手続きページ
     */
    public function checkout()
    {
        return view('cart.checkout');
    }

    /**
     * 注文確認ページ
     */
    public function confirm(Request $request)
    {
        // 入力内容をセッションに保存
        $request->validate([
            'name' => 'required|string|max40',
            'address' => 'required|string|max100',
            'phone' => 'required|string|max20',
        ]);

        session([
            'name' => $request->name,
            'address' => $request->address,
            'phone' => $request->phone,
        ]);

        return view('cart.confirm', [
            'name' => $request->name,
            'address' => $request->address,
            'phone' => $request->phone,
        ]);
    }

    /**
     * 注文処理（注文完了）
     */
    public function placeOrder()
    {
        // 注文処理（セッションからデータを取得して処理）
        $name = session('name');
        $address = session('address');
        $phone = session('phone');

        // 注文処理のロジックをここに追加
        // 例えば、注文をデータベースに保存したり、メールを送信する処理など

        // 注文完了ページにリダイレクト
        return redirect()->route('cart.orderComplete');
    }

    /**
     * 注文完了ページ
     */
    public function orderComplete()
    {
        return view('cart.orderComplete');
    }
}
