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
            <form method="POST" action="{{ route('productspages.store') }}">
                @csrf
                <div class="row mb-3">
                    <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Характеристика') }}</label>
                    <div class="col-md-6">
                        <select class="form-select" aria-label="Disabled select example" type="inputGroupSelect01"
                            name="set_id">
                            @foreach ($sets as $set)
                                <option name="set_id" value="{{ $set->id }}">
                                    {{ $set->title }}({{ $set->type }})</option>
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
                    <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Значение') }}</label>

                    <div class="col-md-6">
                        <input id="value" type="text" class="form-control @error('value') is-invalid @enderror" name="value"
                            value="{{ old('value') }}" autocomplete="value" autofocus>

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
                <input type="hidden" id="product_id" name="product_id" value="{{ $products->id }}">
                <input type="hidden" id="shipment_id" name="shipment_id" value="{{ $shipments->id }}">
                <div class="row mb-3">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Добавить') }}
                        </button>
                    </div>
                </div>
            </form>
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">{{ $products->product_title }}
                        <aside>
                            <div class="d-flex flex-column flex-shrink-5">
                                <div class="row mb-0">
                                    <form method="POST" action="{{ route('productspages.store') }}">
                                        @csrf
                                        Осталось {{ $shipments->count }} шт.
                                        {{-- <button class="btn btn-primary">
                                            {{ __('Задать характеристики') }}
                                        </button> --}}
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
                                            <td>{{ $characteristic->set->title }}</td>
                                            <td>{{ $characteristic->valueint }} {{ $characteristic->valuestr }} {{ $characteristic->valuedec }} {{ $characteristic->valuedate }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            @endforeach
                        </aside>
                        <b>{{ $shipments->price }} ₽</b>
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
