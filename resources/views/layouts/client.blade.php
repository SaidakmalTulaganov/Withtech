<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                    {{-- <a href="/home" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
                            <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap">
                                <use xlink:href="#bootstrap"></use>
                            </svg>
                        </a> --}}

                    <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                        <li><a href="/home" class="nav-link px-2 text-secondary">WITHTECH</a></li>
                        {{-- <li><a href="{{ route('basketProducts.index') }}"
                                class="nav-link px-2 text-secondary">Корзина</a></li> --}}
                        {{-- <li><a href="/about" class="nav-link px-2 text-secondary">Контакты</a></li> --}}
                    </ul>

                    <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" action="{{ route('clientorders.Search') }}">
                        <input type="search" name="search" class="form-control form-control-dark"
                            placeholder="Поиск по заказам..." aria-label="Search">
                    </form>
                </div>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Войти') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Регистрация') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('clients.index') }}">
                                        {{ __('Мой профиль') }}
                                    </a>
                                    <a href="{{ route('clientorders.index') }}" class="dropdown-item">
                                        {{ __('Заказы') }}
                                    </a>
                                    <a href="{{ route('basketProducts.index') }}" class="dropdown-item">
                                        {{ __('Корзина') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                                                                                            document.getElementById('logout-form').submit();">
                                        {{ __('Выйти') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <div class="d-flex flex-column flex-shrink-0 p-3 bg-white shadow-sm" style="width: 280px;">
            {{-- <a href="" class="nav-link px-2 text-secondary">
                <svg class="bi me-2" width="16" height="16">
                    <use xlink:href="#bootstrap"></use>
                </svg>
                КАТАЛОГ ТОВАРОВ
            </a>
            <hr> --}}
            <ul class="nav nav-pills flex-column mb-auto">
                <li>
                    <a href="{{ route('clients.index') }}" class="nav-link px-2 text-secondary" aria-current="page">
                        <svg class="bi me-2" width="16" height="16">
                            <use xlink:href="#home"></use>
                        </svg>
                        Мой профиль
                    </a>
                </li>
                <li>
                    <a href="{{ route('clientorders.index') }}" class="nav-link px-2 text-secondary">
                        <svg class="bi me-2" width="16" height="16">
                            <use xlink:href="#speedometer2"></use>
                        </svg>
                        Заказы
                    </a>
                </li>
                <li>
                    <a href="" class="nav-link px-2 text-secondary">
                        <svg class="bi me-2" width="16" height="16">
                            <use xlink:href="#table"></use>
                        </svg>
                        Доставка
                    </a>
                </li>
                <li>
                    <a href="" class="nav-link px-2 text-secondary">
                        <svg class="bi me-2" width="16" height="16">
                            <use xlink:href="#grid"></use>
                        </svg>
                        Избранное
                    </a>
                </li>
                <li>
                    <a href="{{ route('basketProducts.index') }}" class="nav-link px-2 text-secondary">
                        <svg class="bi me-2" width="16" height="16">
                            <use xlink:href="#grid"></use>
                        </svg>
                        Корзина
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <main class="py-4">
        @yield('content')
    </main>
</body>

</html>
