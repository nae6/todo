@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/complete.css') }}">
@endsection

@section('content')
<!-- DoneのTodo表示 -->
<div class="complete-content">
    <div class="todo-table">
        <table class="todo-table__inner">
            <colgroup>
                <col class="col-todo">
                <col class="col-cat">
                <col class="col-incomplete">
                <col class="col-delete">
            </colgroup>
            <tr class="todo-table__row">
                <th class="todo-table__header">Todo</th>
                <th>カテゴリ</th>
                <th></th>
                <th></th>
            </tr>
            @foreach ($todos as $todo)
            <tr class="todo-table__row">
                <td>
                    <p class="todo">{{ $todo->content }}</p>
                </td>
                <td>
                    <p class="category">{{ $todo->category?->name }}</p>
                </td>
                <td class="todo-table__item">
                    @if ($todo->is_done)
                    <form action="{{ route('todos.incomplete', $todo->id) }}" method="POST" class="incomplete-form">
                        @method('PATCH')
                        @csrf
                        <div class="incomplete-form__btn">
                            <button type="submit" class="incomplete-form__btn-submit">未完了に戻す</button>
                        </div>
                    </form>
                    @endif
                </td>
                <td class="todo-table__item">
                    <form action="{{ route('todos.delete', $todo->id)}}" method="POST" class="delete-form">
                        @method('DELETE')
                        @csrf
                        <div class="delete-form__btn">
                            <button type="submit" class="delete-form__btn-submit">削除</button>
                        </div>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
    <div class="return__link">
        <a href="{{ route('todos.index') }}">未完了一覧に戻る</a>
    </div>
</div>
@endsection