<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Todo;
use App\Models\Category;
use App\Models\User;
use App\Http\Requests\TodoRequest;

class TodoController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', Todo::class);

        $todos = Todo::with('category:id,name')
            ->forUser(Auth::id())
            ->Incomplete()
            ->latest()
            ->get();

        $categories = Category::select('id', 'name')->get();

        return view('index', compact('todos', 'categories'));
    }

    // 新規作成
    public function store(TodoRequest $request)
    {
        Todo::create([
            'user_id' => Auth::id(),
            'category_id' => $request->category_id,
            'content' => $request->content,
        ]);
        return redirect('/')->with('success', 'Todoを作成しました');
    }

    // 更新
    public function update(TodoRequest $request, Todo $todo)
    {
        $this->authorize('update', $todo);

        $todo->update($request->only(['category_id', 'content']));

        return redirect('/')->with('success', 'Todoを更新しました');
    }

    // 完了フラグ
    public function complete(Todo $todo)
    {
        $this->authorize('update', $todo);

        $todo->update([
            'is_done' => true,
            'completed_at' => now(),
        ]);

        return redirect('/')->with('success', 'Todoを完了にしました');
    }

    // 検索
    public function search(Request $request)
    {
        $this->authorize('viewAny', Todo::class);

        $todos = Todo::with('category:id, name')
            ->forUser(Auth::id())
            ->CategorySearch($request->category_id)
            ->KeywordSearch($request->keyword)
            ->Incomplete()
            ->latest()
            ->get();

        $categories = Category::select('id', 'name')->get();

        return view('index', compact('todos', 'categories'));
    }
    // N+1問題：foreachの中でリレーションを呼んでいる時発生
}
