@can('admin')
    @include('layouts.admin')
@endcan
<style>
    aside {
        /* width: 280px; */
        float: right;
    }

    article {
        margin-right: 240px;
        display: block;
    }
</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 g-3">
            <div class="col">
                <form method="POST" action="{{ route('users.store') }}">
                    @csrf
                    <div class="row mb-3">
                        <label for="name"
                            class="col-md-4 col-form-label text-md-end">{{ __('Тип пользователя') }}</label>

                        <div class="col-md-6">
                            <input id="type_title" type="text"
                                class="form-control @error('type_title') is-invalid @enderror" name="type_title"
                                value="{{ old('type_title') }}" autocomplete="type_title" autofocus>
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Добавить') }}
                            </button>
                        </div>
                    </div>
                    <input type="hidden" id="insert" name="insert" value="Тип">
                </form>
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 g-3">
                    @foreach ($users_types as $users_type)
                        <div class="col">
                            <div class="card">
                                <div class="card-header">{{ $users_type->type_title }}
                                    <aside>
                                        <div class="d-flex flex-column flex-shrink-0">
                                            <div class="row mb-0">
                                                <form action="{{ route('users.destroy', $users_type->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-primary">
                                                        {{ __('Удалить') }}
                                                    </button>
                                                    <input type="hidden" id="delete" name="delete"
                                                        value="Удалить тип">
                                                </form>
                                            </div>
                                        </div>
                                    </aside>
                                </div>
                                <div class="card-body">
                                    @if (session('status'))
                                        <div class="alert alert-success" role="alert">
                                            {{ session('status') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-header">{{ __('Регистрация пользователей') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('users.store') }}">
                            @csrf

                            <div class="row mb-3">
                                <label for="name"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Имя') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="surname"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Фамилия') }}</label>

                                <div class="col-md-6">
                                    <input id="surname" type="text"
                                        class="form-control @error('surname') is-invalid @enderror" name="surname"
                                        value="{{ old('surname') }}" required autocomplete="surname" autofocus>

                                    @error('surname')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="name"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Тип пользователя') }}</label>
                                <div class="col-md-6">
                                    <select class="form-select" aria-label="Disabled select example"
                                        type="inputGroupSelect01" name="type_id">
                                        @foreach ($users_types as $users_type)
                                            <option name="type_id" value="{{ $users_type->id }}">
                                                {{ $users_type->type_title }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Email') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="phone"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Телефон') }}</label>

                                <div class="col-md-6">
                                    <input id="phone" type="text"
                                        class="form-control @error('phone') is-invalid @enderror" name="phone"
                                        value="{{ old('phone') }}" required autocomplete="phone" autofocus>

                                    @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Пароль') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password-confirm"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Подтверждение пароля') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Регистрация') }}
                                    </button>
                                </div>
                            </div>
                            <input type="hidden" id="insert" name="insert" value="Пользователь">
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-6 g-3">
            <div class="col">
                <div class="d-flex flex-column flex-shrink-0 p-3 bg-white shadow-sm">
                    <div class="row mb-0">
                        <form action="{{ route('users.index') }}" method="POST">
                            @csrf
                            @method('GET')
                            <div class="row mb-0">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Администраторы') }}
                                </button>
                            </div>
                            <input type="hidden" id="type" name="type" value="Администраторы">
                        </form>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="d-flex flex-column flex-shrink-0 p-3 bg-white shadow-sm">
                    <div class="row mb-0">
                        <form action="{{ route('users.index') }}" method="POST">
                            @csrf
                            @method('GET')
                            <div class="row mb-0">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Бухгалтеры') }}
                                </button>
                            </div>
                            <input type="hidden" id="type" name="type" value="Бухгалтеры">
                        </form>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="d-flex flex-column flex-shrink-0 p-3 bg-white shadow-sm">
                    <div class="row mb-0">
                        <form action="{{ route('users.index') }}" method="POST">
                            @csrf
                            @method('GET')
                            <div class="row mb-0">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Кладовщики') }}
                                </button>
                            </div>
                            <input type="hidden" id="type" name="type" value="Кладовщики">
                        </form>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="d-flex flex-column flex-shrink-0 p-3 bg-white shadow-sm">
                    <div class="row mb-0">
                        <form action="{{ route('users.index') }}" method="POST">
                            @csrf
                            @method('GET')
                            <div class="row mb-0">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Курьеры') }}
                                </button>
                            </div>
                            <input type="hidden" id="type" name="type" value="Курьеры">
                        </form>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="d-flex flex-column flex-shrink-0 p-3 bg-white shadow-sm">
                    <div class="row mb-0">
                        <form action="{{ route('users.index') }}" method="POST">
                            @csrf
                            @method('GET')
                            <div class="row mb-0">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Директор') }}
                                </button>
                            </div>
                            <input type="hidden" id="type" name="type" value="Директор">
                        </form>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="d-flex flex-column flex-shrink-0 p-3 bg-white shadow-sm">
                    <div class="row mb-0">
                        <form action="{{ route('users.index') }}" method="POST">
                            @csrf
                            @method('GET')
                            <div class="row mb-0">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Клиенты') }}
                                </button>
                            </div>
                            <input type="hidden" id="type" name="type" value="Клиенты">
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
            @foreach ($users as $user)
                <div class="col">
                    <div class="card">
                        <div class="card-header"> {{ $user->name }} {{ $user->surname }}
                        </div>
                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
                            <ul class="list-unstyled mt-3 mb-4">
                                <li>
                                    <b>Тип: {{ $user->type->type_title }}</b>
                                </li>
                                <li>
                                    <b>Email: {{ $user->email }}</b>
                                </li>
                                <li>
                                    <b>Телефон: {{ $user->phone }}</b>
                                </li>
                                <li>
                                    <b>Бонусы: {{ $user->bonus }}</b>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
