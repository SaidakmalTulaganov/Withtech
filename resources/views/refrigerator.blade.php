@extends('layouts.admin')
@section('content')
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
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">{{ $products->product_title }}
                        <aside>
                            <div class="d-flex flex-column flex-shrink-5">
                                <div class="row mb-0">
                                    <form action="{{ route('productsadmin.destroy', $products->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        Осталось {{ $products->shipment->count }} шт.
                                        <button class="btn btn-primary">
                                            {{ __('Редактировать') }}
                                        </button>
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
                        <img src="{{ asset($products->product_image) }}" class="img-thumbnail" width="150px">
                        <aside>
                            @foreach ($characteristics as $characteristic)
                                <table class="iksweb">
                                    <tbody>
                                        <tr>
                                            <td>Количество камер</td>
                                            <td>{{ $characteristic->cameras }}</td>
                                        </tr>
                                        <tr>
                                            <td>Расположение морозильной камеры</td>
                                            <td>{{ $characteristic->freezer_location }}</td>
                                        </tr>
                                        <tr>
                                            <td>Количество дверей</td>
                                            <td>{{ $characteristic->doors }} шт</td>
                                        </tr>
                                        <tr>
                                            <td>Общий объем холодильника</td>
                                            <td>{{ $characteristic->volume }} л</td>
                                        </tr>
                                        <tr>
                                            <td>Уровень шума</td>
                                            <td>{{ $characteristic->noise_level }} дБ</td>
                                        </tr>
                                        <tr>
                                            <td>Количество полок</td>
                                            <td>{{ $characteristic->shelves }}</td>
                                        </tr>
                                        <tr>
                                            <td>Цвет</td>
                                            <td>{{ $characteristic->color }}</td>
                                        </tr>
                                        <tr>
                                            <td>Вес упаковки</td>
                                            <td>{{ $characteristic->weight }} кг</td>
                                        </tr>
                                        <tr>
                                            <td>Гарантия</td>
                                            <td>{{ $characteristic->warranty }} мес</td>
                                        </tr>
                                    </tbody>
                                </table>
                            @endforeach
                        </aside>
                        <b>{{ $products->shipment->price }} ₽</b>
                        <ul class="list-unstyled mt-3 mb-4">
                            <li>
                                {{ $products->description }}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
