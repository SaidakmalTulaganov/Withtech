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

    </style>
    <div class="container">
        <div class="row justify-content-center">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                @foreach ($order_values as $order_value)
                    <div class="col">
                        <div class="card">

                            <div class="card-header">
                                Заказ от
                                {{ $order_value->order_datetime }}
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
                                <a
                                    href="{{ route('products.show', $order_value->product_id) }}">{{ $order_value->description }}</a>
                                <ul class="list-unstyled mt-3 mb-4">
                                    <li>
                                        <h3><b>{{ $order_value->quantity }} шт. на сумму {{ $order_value->price }} ₽</b>
                                        </h3>
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
