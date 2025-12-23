<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $todos = Todo::select('content', 'id')->orderBy('created_at', 'desc')->get();
        return view('index', compact('todos'));
    }

    public function store(TodoRequest $request)
    {
        $todo = $request->only(['content']);
        Todo::create($todo);
        return redirect('/')->with('success', 'Todoを作成しました');
    }

    public function update(TodoRequest $request, Todo $todo)
    {
        $todo->update($request->only('content'));
        return redirect('/')->with('success', 'Todoを更新しました');
    }

    public function destroy(Request $request)
    {
        Todo::find($request->id)->delete();
        return redirect('/')->with('success', 'Todoを削除しました');
    }
}
