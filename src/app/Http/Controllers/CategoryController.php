<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Requests\CategoryRequest;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::select('id', 'name')->get();
        return view('/category', compact('categories'));
    }

    public function store(CategoryRequest $request)
    {
        $category = $request->only(['name']);
        Category::create($category);
        return redirect('/category')->with('success', 'カテゴリを作成しました');
    }

    public function update(CategoryRequest $request, Category $category)
    {
        $category->update($request->only(['name']));
        return redirect('/category')->with('success', 'カテゴリを更新しました');
    }

    public function destroy(Request $request, Category $category)
    {
        $category->delete();
        return redirect('/category')->with('success', 'カテゴリを削除しました');
    }
}
