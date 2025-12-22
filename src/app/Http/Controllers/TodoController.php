<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;
use App\Http\Requests\TodoRequest;

class TodoController extends Controller
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
        // $todo = $request->only('content');
        // Todo::find($request->id)->update($todo);

        // $todo = Todo::findOrFail($id);
        // $todo->update($request->only('content'));

        $todo->update($request->only('content'));

        return redirect('/')->with('success', 'Todoを更新しました');
    }

    public function destroy(Request $request)
    {
        Todo::find($request->id)->delete();
        return redirect('/')->with('success', 'Todoを削除しました');
    }
}
