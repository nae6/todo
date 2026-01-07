@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<div class="todo__alert">
    @if (session('success'))
    <div class="todo__alert--success">
        {{ session('success')}}
    </div>
    @endif
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

<div class="todo__content">
    <!-- 新規作成 -->
    <div class="new-create">
        <h2 class="create-form__header">新規作成</h2>
        <form action="{{ route('todos.store') }}" method="post" class="create-form">
            @csrf
            <div class="create-form__item">
                <input type="text" name="content" value="{{ $errors->any() ? old('content') : '' }}" class="create-form__item--input">
                <select name="category_id" class="create-form__item--select">
                    <option value="" selected disabled>カテゴリ</option>
                    @foreach ($categories as $category)
                    <option value="{{ $category->id }}" class="category-item">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="create-form__btn">
                <button type="submit" class="create-form__btn--submit">作成</button>
            </div>
        </form>
    </div>
    <!-- Todo検索 -->
    <div class="new-create">
        <h2 class="create-form__header">Todo検索</h2>
        <form action="{{ route('todos.search') }}" method="get" class="create-form">
            @csrf
            <div class="create-form__item">
                <input type="text" name="keyword" value="{{ old('keyword') }}" class="create-form__item--input">
                <select name="category_id" class="create-form__item--select">
                    <option value="" selected disabled>カテゴリ</option>
                    @foreach ($categories as $category)
                    <option value="{{ $category->id }}" class="category-item">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="create-form__btn">
                <button type="submit" class="create-form__btn--submit">検索</button>
            </div>
        </form>
    </div>

    <!-- Todo表示 -->
    <div class="todo-table">
        <table class="todo-table__inner">
            <colgroup>
                <col class="col-todo">
                <col class="col-cat">
                <col class="col-update">
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
                <!-- <td class="todo-table__item"> -->
                <form class="update-form" action="{{ route('todos.update', $todo) }}" method="POST">
                    @method('PATCH')
                    @csrf
                    <td>
                        <!-- <div class="update-form__item1"> -->
                        <input class="update-form__item--input" type="text" name="content" value="{{ $todo->content }}">
                        <!-- </div> -->
                    </td>
                    <td>
                        <!-- <div class="update-form__item2"> -->
                            <p class="update-form__item-category">{{ $todo->category?->name }}</p>
                        <!-- </div> -->
                    </td>
                    <td>
                        <div class="update-form__btn">
                            <button type="submit" class="update-form__btn-submit">更新</button>
                        </div>
                    </td>
                </form>
                <!-- </td> -->
                <td class="todo-table__item">
                    @if (!$todo->is_done)
                    <form action="{{ route('todos.complete', $todo) }}" method="POST" class="delete-form">
                        @method('PATCH')
                        @csrf
                        <div class="delete-form__btn">
                            <button type="submit" class="delete-form__btn-submit">完了</button>
                        </div>
                    </form>
                    @endif
                </td>
            </tr>
            @endforeach
        </table>
    </div>
    <div class="category-list">
        <div class="category-list__inner">
            <a href="{{ route('category.index') }}" class="category-list__link">カテゴリ一覧</a>
        </div>
        <div class="complete-list">
            <a href="{{ route('todos.completed') }}">完了済み一覧</a>
        </div>
    </div>
</div>
@endsection