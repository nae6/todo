<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;

class TodoController extends Controller
{
    public function index()
    {
        $todos = Todo::select('content')->orderBy('created_at')->get();
        return view('index', compact('todos'));
    }

    public function store(Request $request)
    {
        $todo =$request->only(['content']);
        Todo::create($todo);
        return redirect('/')->back()->with('success', 'Todoを作成しました');
    }
}
