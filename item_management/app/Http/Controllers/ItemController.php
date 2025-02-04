<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Item;
use App\Models\Category;

class ItemController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * 商品一覧（検索機能付き）
     */
    public function index(Request $request)
    {
        $query = Item::query();

        // 検索処理
        if ($request->filled('keyword')) {
            $keyword = $request->input('keyword');
            $match = $request->input('match', 'partial');

            if ($match === 'exact') {
                $query->where('name', $keyword);
            } else {
                $query->where('name', 'LIKE', "%{$keyword}%");
            }
        }

        // 商品一覧を取得
        $items = $query->paginate(10); // ページネーション

        return view('item.index', compact('items'));
    }

    /**
     * 商品登録フォーム表示
     */
    public function create()
    {
        $categories = Category::all(); // カテゴリ情報を取得
        return view('item.create', compact('categories')); // フォーム表示
    }

    /**
     * 商品登録処理
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|exists:categories,id', // カテゴリIDでチェック
            'detail' => 'nullable|string',
            'company_name' => 'nullable|string',
            'price' => 'required|numeric|min:1', // 価格のバリデーション
            'image' => 'nullable|image|max:2048',
        ]);

        // 画像アップロード処理
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('items', 'public');
        } else {
            $imagePath = null;
        }

        // データ保存
        Item::create([
            'name' => $request->name,
            'category_id' => $request->category, // カテゴリIDを保存
            'detail' => $request->detail,
            'company_name' => $request->company_name,
            'price' => $request->price, // 価格も保存
            'image' => $imagePath,
            'user_id' => Auth::id(), // ユーザーIDを保存
        ]);

        return redirect()->route('item.index')->with('success', '商品が登録されました');
    }

    /**
     * 商品詳細ページ
     */
    public function show($id)
    {
        $item = Item::findOrFail($id);
        return view('item.show', compact('item'));
    }

    /**
     * 商品編集画面
     */
    public function edit($id)
    {
        $item = Item::findOrFail($id);
        $categories = Category::all(); // カテゴリ情報を取得
        return view('item.edit', compact('item', 'categories'));
    }

    /**
     * 商品更新処理
     */
    public function update(Request $request, Item $item)
    {
        $this->authorize('update', $item);

        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|exists:categories,id', // カテゴリIDでチェック
            'price' => 'required|numeric|min:1', // 価格もバリデーションに追加
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // 画像の処理
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->storeAs('public/product_image', $request->file('image')->getClientOriginalName());
            $item->image = $imagePath;
        }

        // 商品データの更新
        $item->update([
            'name' => $request->name,
            'category_id' => $request->category, // カテゴリIDを更新
            'price' => $request->price, // 価格も更新
        ]);

        return redirect()->route('item.index')->with('success', '商品情報を更新しました！');
    }

    /**
     * 商品削除処理
     */
    public function destroy($id)
    {
        $item = Item::findOrFail($id);
        $item->delete();
        return redirect()->route('item.index')->with('success', '商品が削除されました。');
    }
}
