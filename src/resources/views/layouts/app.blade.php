<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo List</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    @yield('css')
</head>

<body>
    <header class="header">
        <div class="header__inner">
            <div>
                <a href="/" class="header__logo">Todo</a>
            </div>
            <nav>
                <ul class="header-nav">
                    @if (Auth::check())
                    <li class="header-nav__item">
                        @auth
                        <span>ようこそ、{{ Auth::user()->name }}さん</span>
                        @endauth
                    </li>
                    <li class="header-nav__item">
                        <form action="/logout" method="post">
                        @csrf
                            <button class="header-nav__button">ログアウト</button>
                        </form>
                    </li>
                    @endif
                </ul>
            </nav>
        </div>
    </header>

    <main>
        @yield('content')
    </main>
</body>

</html>