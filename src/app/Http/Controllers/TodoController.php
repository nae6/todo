<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;
use App\Models\Category;
use App\Models\User;
use App\Http\Requests\TodoRequest;

class TodoController extends Controller
{
    public function index()
    {
        $todos = Todo::with('category:id,name')
            ->orderBy('created_at', 'desc')
            ->get();
        $categories = Category::get();
        return view('index', compact('todos', 'categories'));
    }

    public function store(TodoRequest $request)
    {
        $todo = $request->only(['category_id', 'content']);
        Todo::create($todo);
        return redirect('/')->with('success', 'Todoを作成しました');
    }

    public function update(TodoRequest $request, Todo $todo)
    {
        $todo->update($request->only(['category_id', 'content']));
        return redirect('/')->with('success', 'Todoを更新しました');
    }

    public function destroy(Request $request)
    {
        Todo::find($request->id)->delete();
        return redirect('/')->with('success', 'Todoを削除しました');
    }

    public function search(Request $request)
    {
        $todos = Todo::with('category')->CategorySearch($request->category_id)->KeywordSearch($request->keyword)->get();
        $categories = Category::select('id', 'name')->get();
        return view('index', compact('todos', 'categories'));
    }
    // N+1問題：foreachの中でリレーションを呼んでいる時発生
}
