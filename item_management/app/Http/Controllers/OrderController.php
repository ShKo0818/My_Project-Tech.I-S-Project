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
        $usedCategories = Item::distinct()->pluck('category_id');
    
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
            'category' => 'required',
        ]);

        // 発注内容をセッションに保存（確認画面で使うため）
        $request->session()->put('order', [
            'item_name' => $request->item_name,
            'quantity' => $request->quantity,
            'price' => $request->price,
            'category' => $request->category,
            'company_name' => Auth::user()->company_name,
        ]);

        return redirect()->route('order.confirm'); // 確認画面に遷移
    }

    public function confirm(Request $request)
    {
        // セッションから発注内容を取得
        $order = $request->session()->get('order');
        return view('orders.confirm', compact('order')); // 確認画面ビューを返す
    }

    public function finalStore(Request $request)
    {
        // 発注確認後、実際の発注処理
        $order = $request->session()->get('order');

        // 法人ユーザーのカテゴリをDBに登録（もし存在しない場合）
        if (Auth::user()->user_type === 'corporate') {
            $category = Category::firstOrCreate(['name' => $order['category']]);
        } else {
            $category = Category::find($order['category']);
        }

        // 注文データを保存
        Order::create([
            'user_id' => auth()->id(),
            'item_id' => Item::where('name', $order['item_name'])->first()->id,
            'quantity' => $order['quantity'],
            'price' => $order['price'],
            'category_id' => $category->id,
            'company_name' => Auth::user()->company_name,
        ]);

        // セッションから発注内容を削除
        $request->session()->forget('order');

        // 発注完了メッセージ
        return redirect()->route('order.create')->with('success', '発注しました！');
    }
}
