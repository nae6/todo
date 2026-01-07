@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/category.css') }}">
@endsection

@section('content')
<div class="category__alert">
    @if (session('success'))
    <div class="category__alert--success">
        {{ session('success')}}
    </div>
    @endif
    @if ($errors->any())
    <div class="category__alert--danger">
        <ul class="category__alert--list">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
</div>

<div class="category__content">
    <!-- カテゴリ作成 -->
    <form action="{{ route('category.store') }}" method="post" class="create-form">
        @csrf
        <div class="create-form__item">
            <input type="text" name="name" value="{{ $errors->any() ? old('name') : '' }}" class="create-form__item--input">
        </div>
        <div class="create-form__btn">
            <button type="submit" class="create-form__btn--submit">作成</button>
        </div>
    </form>

    <!-- category表示 -->
    <div class="category-table">
        <table class="category-table__inner">
            <tr class="category-table__row">
                <th class="category-table__header">category</th>
                <th></th>
            </tr>
            @foreach ($categories as $category)
            <tr class="category-table__row">
                <td class="category-table__item">
                    <form class="update-form" action="{{ route('category.update', $category) }}" method="POST">
                        @method('PATCH')
                        @csrf
                        <div class="update-form__item">
                            <input class="update-form__item--input" type="text" name="name" value="{{ $category->name }}">
                        </div>
                        <div class="update-form__btn">
                            <button type="submit" class="update-form__btn-submit">更新</button>
                        </div>
                    </form>
                </td>
                <td class="todo-table__item">
                    <form action="{{ route('category.delete', $category) }}" method="POST" class="delete-form">
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