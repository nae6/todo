@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/complete.css') }}">
@endsection

@section('content')
<div class="category__content">
    <!-- category表示 -->
    <div class="category-table">
        <table class="category-table__inner">
            <tr class="category-table__row">
                <th class="category-table__header">完了済みTodo</th>
                <th></th>
            </tr>
            @foreach ($categories as $category)
            <tr class="category-table__row">
                <td class="category-table__item">
                    {{ $category['name'] }}
                </td>
                <td class="todo-table__item">
                    <form action="/category/delete/{{ $category->id}}" method="POST" class="delete-form">
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
</div>
@endsection