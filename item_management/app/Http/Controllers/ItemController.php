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
        $categories = Category::all();
        return view('item.create', compact('categories'));
    }

    /**
     * 商品登録処理
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'nullable|exists:categories,id|max:50',
            'detail' => 'required|string|max:50',
            'company_name' => 'required|string|max:50',
            'price' => 'required|numeric|min:1',
            'image' => 'nullable|image|max:2048',
        ]);

        // 画像アップロード処理
        $imagePath = $request->hasFile('image') 
            ? $request->file('image')->store('items', 'public') 
            : null;

        // `company_name` はマスターのみ変更可能
        $companyName = Auth::user()->user_type === 'master' 
            ? $request->company_name 
            : Auth::user()->company_name;

        Item::create([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'detail' => $request->detail,
            'company_name' => $companyName,
            'price' => $request->price,
            'image' => $imagePath,
            'user_id' => Auth::id(),
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
        $categories = Category::all();
        return view('item.edit', compact('item', 'categories'));
    }

    /**
     * 商品更新処理
     */
    public function update(Request $request, Item $item)
    {

        dd(auth()->user()); // ここでログインユーザー情報を確認

        $this->authorize('update', $item);

        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'nullable|exists:categories,id|max:50',
            'price' => 'required|numeric|min:1',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // 画像の処理
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('items', 'public');
            $item->image = $imagePath;
        }

        // category_id が送信されていない場合は、現在の値を維持
        $categoryId = $request->filled('category_id') ? $request->category_id : $item->category_id;

        // 更新データの取得
        $updateData = [
            'name' => $request->name,
            'category_id' => $categoryId,
            'price' => $request->price,
        ];

        // 変更がない場合はリダイレクト
        if ($item->only(array_keys($updateData)) == $updateData) {
            return redirect()->route('item.index')->with('info', '変更はありませんでした。');
        }

        $item->update($updateData);

        return redirect()->route('item.index')->with('success', '商品情報を更新しました！');
    }

    /**
     * 商品削除処理
     */
    public function destroy($id)
    {
        $item = Item::findOrFail($id);
        try {
            $item->delete();
            return redirect()->route('item.index')->with('success', '商品が削除されました。');
        } catch (\Exception $e) {
            return redirect()->route('item.index')->with('error', '削除に失敗しました。');
        }
    }
}
