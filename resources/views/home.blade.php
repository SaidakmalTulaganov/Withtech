@can('client')
    @include('layouts.app')

    {{-- @section('content') --}}
    {{-- <style>
            aside {
                /* width: 280px; */
                float: right;
            }

            article {
                margin-right: 240px;
                display: block;
            }

        </style>
        <aside>
            <div class="d-flex flex-column flex-shrink-0 p-3 bg-white shadow-sm">
                <div class="row mb-0">
                    <h3><b>Итого: {{ $price }} ₽</b>
                    </h3>
                    <a href="{{ route('home.show', $product->id) }}" class="btn btn-primary">
                        {{ __('по цене') }}
                    </a>
                </div>
            </div>
        </aside> --}}
    <div class="container">
        <div class="row justify-content-center">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                @foreach ($shipments as $shipment)
                    <div class="col">
                        <div class="card">

                            <div class="card-header">{{ $shipment->product->product_title }}</div>
                            <div class="card-body">
                                @if (session('status'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @endif
                                <div style="min-height: 30em">
                                    <img src="{{ asset($shipment->product->product_image) }}" class="img-thumbnail">
                                </div>
                                <a href="{{ route('products.show', $shipment->id) }}">{{ $shipment->product->description }}</a>
                                <ul class="list-unstyled mt-3 mb-4">
                                    <li>
                                        <h3><b>{{ $shipment->selling_price }} ₽</b></h3>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    {{-- @endsection --}}
@endcan
@can('admin')
    @include('layouts.admin')
@endcan
@can('accountant')
    @include('layouts.accountant')
@endcan
