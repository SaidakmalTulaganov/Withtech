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
                @foreach ($order_sets as $order_set)
                    <div class="col">
                        <div class="card">
                            <div class="card-header">
                                <a href="{{ route('clientorders.show', $order_set->id) }}">Заказ от {{ $order_set->order_datetime }}</a>
                                <aside>
                                    <div class="d-flex flex-column flex-shrink-0">
                                        <div class="row mb-0">
                                            <form action="" method="POST">
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
                                        <b>Заказ на сумму {{ $order_set->order_price }} ₽</b>
                                    </li>
                                </ul>
                                {{-- <div style="min-height: 30em">
                                    <img src="{{ asset($order_set->product_image) }}" class="img-thumbnail">
                                </div>
                                <a href="{{ route('products.show', $order_set->product_id) }}">{{ $order_set->description }}</a>
                                <ul class="list-unstyled mt-3 mb-4">
                                    <li>
                                        <h3><b>{{ $order_set->quantity }} шт. на сумму {{ $order_set->price }} ₽</b></h3>
                                    </li>
                                </ul> --}}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

@endcan
