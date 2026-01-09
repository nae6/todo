<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Requests\CategoryRequest;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', Category::class);

        $categories = Category::where('user_id', Auth::id())
            ->select('id', 'name')
            ->get();
        return view('/category', compact('categories'));
    }

    // 作成
    public function store(CategoryRequest $request)
    {
        Category::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
        ]);

        return redirect('/category')->with('success', 'カテゴリを作成しました');
    }

    // 更新
    public function update(CategoryRequest $request, Category $category)
    {
        $this->authorize('update', $category);

        $category->update($request->only(['name']));

        return redirect('/category')->with('success', 'カテゴリを更新しました');
    }

    // 削除
    public function destroy(Request $request, Category $category)
    {
        $this->authorize('delete', $category);

        $category->delete();

        return redirect('/category')->with('success', 'カテゴリを削除しました');
    }
}