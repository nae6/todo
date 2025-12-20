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
    <div class="todo__alert--danger">
        Todoを入力してください
    </div>
</div>

<!-- todo内容 -->
<div class="todo__content">
    <form action="/todos" method="post" class="create-form">
        @csrf
        <div class="create-form__item">
            <input type="text" name="content" class="create-form__item--input">
        </div>
        <div class="create-form__btn">
            <button type="submit" class="create-form__btn--submit">作成</button>
        </div>
    </form>
    <div class="todo-table">
        <table class="todo-table__inner">
            <!-- <colgroup class="col-table"> -->
                <!-- <col class="col-update"> -->
                <!-- <col class="col-delete"> -->
            <!-- </colgroup> -->
            <tr class="todo-table__row">
                <th class="todo-table__header">Todo</th>
                <th></th>
            </tr>
            @foreach ($todos as $todo)
            <tr class="todo-table__row">
                <td class="todo-table__item">
                    <form action="" method="" class="update-form">
                        @csrf
                        <div class="update-form__item">
                            <input type="text" name="content" value="{{ $todo['content'] }}" class="update-form__item--input">
                        </div>
                        <div class="update-form_btn">
                            <button type="submit" class="update-form__btn-submit">更新</button>
                        </div>
                    </form>
                </td>
                <td class="todo-table__item">
                    <form action="" method="" class="delete-form">
                        <div class="delete-form__btn">
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