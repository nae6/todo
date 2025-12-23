@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
@if (session('success'))
<div class="todo__alert">
    <div class="todo__alert--success">
        {{ session('success')}}
    </div>
</div>
@endif
<div class="todo__alert">
    <!-- エラーが複数あるときの書き方 -->
    @if ($errors->any())
    <div class="todo__alert--danger">
        <ul class="todo__alert--list">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
</div>

<!-- todo内容 -->
<div class="todo__content">
    <form action="/todos" method="post" class="create-form">
        @csrf
        <div class="create-form__item">
            <input type="text" name="content" value="{{ $errors->any() ? old('title') : '' }}" class="create-form__item--input">
        </div>
        <div class="create-form__btn">
            <button type="submit" class="create-form__btn--submit">作成</button>
        </div>
    </form>
    <div class="todo-table">
        <table class="todo-table__inner">

            <tr class="todo-table__row">
                <th class="todo-table__header">Todo</th>
                <th></th>
            </tr>
            @foreach ($todos as $todo)
            <tr class="todo-table__row">
                <td class="todo-table__item">
                    <form class="update-form" action="/todos/{{ $todo->id }}" method="POST">
                        @method('PATCH')
                        @csrf
                        <div class="update-form__item">
                            <input class="update-form__item--input" type="text" name="content" value="{{ $todo['content'] }}">
                        </div>
                        <div class="update-form__btn">
                            <button type="submit" class="update-form__btn-submit">更新</button>
                        </div>
                    </form>
                </td>
                <td class="todo-table__item">
                    <form action="/todos/delete" method="POST" class="delete-form">
                        @method('DELETE')
                        @csrf
                        <div class="delete-form__btn">
                            <input type="hidden" name="id" value="{{ $todo['id'] }}">
                            <button type="submit" class="delete-form__btn-submit">削除</button>
                        </div>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</div>
@endsection