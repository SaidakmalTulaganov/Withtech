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

    </style>
    <div class="container">
        <div class="row justify-content-center">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                @foreach ($order_values as $order_value)
                    <div class="col">
                        <div class="card">

                            <div class="card-header">
                                {{-- <a href="{{ route('clientorders.show', $order_value->id) }}">Заказ от
                                {{ $order_value->order_datetime }}</a> --}}
                                Заказ от
                                {{ $order_value->order_datetime }}
                                {{-- <aside>
                                    <div class="d-flex flex-column flex-shrink-0">
                                        <div class="row mb-0">
                                            <form action="" method="POST">
                                                {{ $order_value->order_status }}
                                            </form>
                                        </div>
                                    </div>
                                </aside> --}}
                            </div>
                            <div class="card-body">
                                @if (session('status'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @endif
                                <div style="min-height: 30em">
                                    <img src="{{ asset($order_value->product_image) }}" class="img-thumbnail">
                                </div>
                                {{-- <a
                                    href="{{ route('products.show', $order_value->product_id) }}">{{ $order_value->description }}</a> --}}
                                {{ $order_value->description }}
                                <ul class="list-unstyled mt-3 mb-4">
                                    <li>
                                        <b>{{ $order_value->quantity }} шт. на сумму {{ $order_value->price }} ₽</b>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
