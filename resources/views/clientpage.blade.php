@can('client')
    @include('layouts.client')
    <style>
        aside {
            /* width: 280px; */
            float: right;
        }

        article {
            margin-right: 240px;
            display: block;
        }

        /* Стили таблицы (IKSWEB) */
        table.iksweb {
            text-decoration: none;
            border-collapse: collapse;
            /* width: 300px; */
            text-align: left;
        }

        table.iksweb th {
            font-weight: normal;
            font-size: 1px;
            color: #000000;
            background-color: #ffffff;
        }

        table.iksweb td {
            font-size: 14px;
            color: #000000;
        }

        table.iksweb td,
        table.iksweb th {
            white-space: pre-wrap;
            padding: 10px 5px;
            line-height: 13px;
            vertical-align: middle;
            border: 0px solid #c9c9c9;
        }

        table.iksweb tr:hover {
            background-color: #f9fafb
        }

        table.iksweb tr:hover td {
            color: #000000;
            cursor: default;
        }

    </style>
    <div class="container">
        <div class="row justify-content-center">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                {{-- @foreach ($order_sets as $order_set) --}}
                <div class="col">
                    <div class="card">
                        <div class="card-header">Профиль</div>
                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
                            <ul class="list-unstyled mt-3 mb-4">
                                <li>
                                    <b>{{ $user->name }} {{ $user->surname }}</b>
                                </li>
                                <li>
                                    <b>Email: {{ $user->email }}</b>
                                </li>
                                <li>
                                    <b>Телефон: {{ $user->phone }}</b>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card">
                        <div class="card-header">Бонусы</div>
                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
                            <ul class="list-unstyled mt-3 mb-4">
                                <li>
                                    <b>Баланс бонусов: {{ $user->bonus }}</b>
                                </li>
                                @foreach ($bonuses as $bonus)
                                    <li>
                                        <b>{{ $bonus->values }} <a
                                                href="{{ route('clientorders.show', $bonus->set_id) }}">Заказ от
                                                {{ $bonus->set->order_datetime }}</a></b>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                {{-- @endforeach --}}
            </div>
        </div>
    </div>
@endcan
