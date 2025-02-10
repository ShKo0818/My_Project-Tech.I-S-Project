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
     * カートに商品を追加
     */
    public function add(Request $request)
    {
        $id = $request->input('item_id');
        $quantity = (int) $request->input('quantity', 1); // フォームの数量を取得（デフォルト1）
        $item = Item::findOrFail($id);

        // セッションからカートを取得
        $cart = session()->get('cart', []);

        // 商品がすでにカートにある場合は数量を加算
        if (isset($cart[$id])) {
            $cart[$id]['quantity'] += $quantity;
        } else {
            // 新規追加
            $cart[$id] = [
                'name' => $item->name,
                'price' => $item->price ?? 0, 
                'quantity' => $quantity, // フォームの数量を適用
                'image' => asset('storage/' . $item->image),
            ];
        }

        // カートをセッションに保存
        session()->put('cart', $cart);

        // 合計金額を再計算
        $totalPrice = array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cart));
        session()->put('cart_total', $totalPrice);

        return redirect()->route('cart.index')->with('success', '商品をカートに追加しました！');
    }

    /**
     * カート内の商品を削除
     */
    public function remove(Request $request)
    {
        $id = $request->input('item_id');
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        // 合計金額を再計算
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
        $request->validate([
            'name' => 'required|string|max:30',
            'address' => 'required|string|max:100',
            'phone' => 'required|string|max:20',
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
     * 注文処理
     */
    public function placeOrder()
    {
        $name = session('name');
        $address = session('address');
        $phone = session('phone');

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
