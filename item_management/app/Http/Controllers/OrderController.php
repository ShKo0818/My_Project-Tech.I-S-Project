<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Item;
use App\Models\Category;
use Auth;

class OrderController extends Controller
{
    public function create()
    {
        // 商品一覧を取得
        $items = Item::all();

        // 使用されたカテゴリ（商品に関連付けられているカテゴリ）を取得
        $usedCategories = Item::select('category_id')->distinct()->pluck('category_id');

        // 使用されたカテゴリを取得（IDを使ってカテゴリ名を取得）
        $categories = Category::whereIn('id', $usedCategories)->get();

        return view('orders.order', compact('items', 'categories'));
    }

    public function store(Request $request)
    {
        // バリデーション
        $request->validate([
            'item_name' => 'required|exists:items,name',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
        ]);

        // 発注内容をセッションに保存（確認画面で使うため）
        $orderData = [
            'item_name' => $request->item_name,
            'quantity' => $request->quantity,
            'price' => $request->price,
            'category' => $request->category ?? null, // カテゴリがない場合はnull
            'company_name' => Auth::user()->company_name,
        ];

        // セッションに保存
        $request->session()->put('order', $orderData);

        // 直接確認画面に遷移
        return view('orders.confirm', compact('orderData'));
    }

    public function confirm(Request $request)
    {
        // セッションから発注内容を取得
        $order = $request->session()->get('order');
        return view('orders.confirm', compact('order'));
    }

    public function finalStore(Request $request)
    {
        // セッションから発注内容を取得
        $order = $request->session()->get('order');

        // アイテムの確認
        $item = Item::where('name', $order['item_name'])->first();
        if (!$item) {
            // アイテムが見つからない場合はエラーメッセージを返す
            return redirect()->route('order.create')->with('error', '指定されたアイテムは存在しません');
        }

        // カテゴリの確認（カテゴリがnullでもエラーは発生しない）
        $category = $order['category'] ? Category::find($order['category']) : null;

        // 注文データを保存
        Order::create([
            'user_id' => auth()->id(),
            'item_id' => $item->id,
            'name' => $order['item_name'],
            'quantity' => $order['quantity'],
            'price' => $order['price'],
            'category_id' => $category ? $category->id : null,
            'company_name' => Auth::user()->company_name,
        ]);

        // セッションから発注内容を削除
        $request->session()->forget('order');

        // 発注完了メッセージ
        return redirect()->route('order.create')->with('success', '発注しました！');
    }
}
