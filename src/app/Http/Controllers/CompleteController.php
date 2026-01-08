<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Todo;
use Illuminate\Support\Facades\Auth;

class CompleteController extends Controller
{
    public function index()
    {
        $todos = Todo::with('category:id,name')
            ->forUser(Auth::id())
            ->where('is_done', true)
            ->latest()
            ->get();

        $categories = Category::select('id', 'name')->get();

        return view('complete', compact('todos', 'categories'));
    }

    // 完了を未完了にする
    public function incomplete(Todo $todo)
    {
        $this->authorize('update', $todo);

        $todo->update([
            'is_done' => false,
            'completed_at' => null,
        ]);

        return redirect()->route('todos.completed')->with('success', 'Todoを未完了に戻しました');
    }

    // 削除する
    public function destroy(Todo $todo)
    {
        $this->authorize('delete', $todo);

        $todo->delete();

        return redirect()->route('todos.completed')->with('success', 'Todoを削除しました');
    }
}
