@can('admin')
    @include('layouts.admin')
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
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                @foreach ($order_sets as $order_set)
                    <div class="col">
                        <div class="card">
                            <div class="card-header">
                                <a href="{{ route('ordersadmin.show', $order_set->id) }}">Заказ от
                                    {{ $order_set->order_datetime }}</a>
                                <aside>
                                    <div class="d-flex flex-column flex-shrink-0">
                                        <div class="row mb-0">
                                            <form action="" method="POST">
                                                @csrf
                                                {{ $order_set->state->title }}
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
                                <ul class="list-unstyled mt-3 mb-4">
                                    <li>
                                        <b>Покупатель: {{ $order_set->user->name }} {{ $order_set->user->surname }}</b>
                                    </li>
                                    <li>
                                        <b>Телефон: {{ $order_set->user->phone }}</b>
                                    </li>
                                    <li>
                                        <b>Адрес доставки: {{ $order_set->delivery_address }}</b>
                                    </li>
                                    <li>
                                        <b>Сумма заказа: {{ $order_set->order_price }} ₽</b>
                                    </li>
                                    <li>
                                        <b>Способ оплаты: {{ $order_set->payment_type }}</b>
                                    </li>
                                </ul>
                                <aside>
                                    <div class="d-flex flex-column flex-shrink-0">
                                        <div class="row mb-0">
                                            <form action="{{ route('ordersadmin.update', $order_set->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 g-3">
                                                    <div class="col">
                                                            <select class="form-select" aria-label="Disabled select example"
                                                                type="inputGroupSelect01" name="state_id">
                                                                @foreach ($states as $state)
                                                                    <option name="state_id" value="{{ $state->id }}">
                                                                        {{ $state->title }}</option>
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
                                                    <div class="col">
                                                        <button class="btn btn-primary">
                                                            {{ __('Редактировать') }}
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </aside>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endcan
@can('accountant')
    @include('layouts.accountant')
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
            <form action="{{ route('ordersadmin.export') }}" method="POST">
                @csrf
                @method('GET')
                <div class="row mb-0">
                    <div class="col-md-6 offset-md-4">
                        Выгрузить отчет по всем заказам
                        <button type="submit" class="btn btn-primary">
                            {{ __('Выгрузить') }}
                        </button>
                    </div>
                </div>
            </form>
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                @foreach ($order_sets as $order_set)
                    <div class="col">
                        <div class="card">
                            <div class="card-header">
                                <a href="{{ route('ordersadmin.show', $order_set->id) }}">Заказ № {{ $order_set->id }}
                                    от
                                    {{ $order_set->order_datetime }}</a>
                                <aside>
                                    <div class="d-flex flex-column flex-shrink-0">
                                        <div class="row mb-0">
                                            <form action="" method="POST">
                                                @csrf
                                                {{ $order_set->state->title }}
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
                                <ul class="list-unstyled mt-3 mb-4">
                                    <li>
                                        <b>Покупатель: {{ $order_set->user->surname }}
                                            {{ $order_set->user->name }}</b>
                                    </li>
                                    <li>
                                        <b>Адрес доставки: {{ $order_set->delivery_address }}</b>
                                    </li>
                                    <li>
                                        <b>Общая сумма заказа: {{ $order_set->order_price }} ₽</b>
                                    </li>
                                    <li>
                                        <b>Способ оплаты: {{ $order_set->payment_type }}</b>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endcan
