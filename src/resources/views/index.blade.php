@extends('layouts/app.blade.php')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<!-- validationのsessionで設定 -->
<div class="todo__alert">
    <div class="todo__alert--success">
        Todoを作成しました
    </div>
</div>
<!-- セッションここまで -->

<!-- todo内容 -->
<div class="todo__content">
    <form action="" methot="" class="create-form">
        @csrf
        <div class="create-form_item">
            <input type="text" name="" value="" class="create-form_item-input">
        </div>
        <div class="create-form_btn">
            <button type="submit" class="create-form_btn-submit">作成</button>
        </div>
    </form>
    <div class="todo-table">
        <table class="todo-table__inner">
            <tr class="todo-table__row">
                <th class="todo-table__header">Todo</th>
            </tr>
            <tr class="todo-table__row">
                <td class="todo-table__item">
                    <form action="" method="" class="update-form">
                        @csrf
                        <div class="update-form__item">
                            <input type="text" name="" value="" class="update-form__item-input">
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
        </table>
    </div>
</div>
@endsection