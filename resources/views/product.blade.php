@can('client')
    @include('layouts.app')

    {{-- @section('content') --}}
    <?php $user = auth()->user();
    ?>
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
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ $products->product_title }}</div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <img src="{{ asset($products->product_image) }}" class="img-thumbnail" width="250px">
                        <aside>
                            @foreach ($characteristics as $characteristic)
                                <table class="iksweb">
                                    <tbody>
                                        <tr>
                                            <td>{{ $characteristic->set->title }}</td>
                                            <td>{{ $characteristic->valueint }} {{ $characteristic->valuestr }} {{ $characteristic->valuedec }} {{ $characteristic->valuedate }} {{ $characteristic->set->measure }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            @endforeach
                        </aside>
                        <h3>{{ $products->description }}</h3>
                        <ul class="list-unstyled mt-3 mb-4">
                            <li>
                                <h3><b>{{ $shipments->selling_price }} ₽</b></h3>
                            </li>
                        </ul>
                        <div class="js--ProductHeader__count-selector-container ProductHeader__count-selector-container">
                            <div id=""
                                class="ProductHeader__count-selector js--ProductHeader__count-selector CountSelector js--CountSelector">
                                <form action="{{ route('basketProducts.store') }}" method="POST">
                                    @csrf
                                    <div class="row mb-0">
                                        <div class="col-md-6 offset-md-4">
                                            <button type="submit" class="btn btn-primary">
                                                {{ __('В корзину') }}
                                            </button>
                                            <input class="js--CountSelector__input CountSelector__input" type="number"
                                                value="1" min="1" max="50" step="1" data-step="1" required=""
                                                name="quantity">
                                        </div>
                                    </div>
                                    <input type="hidden" id="productId" name="productId" value="{{ $products->id }}">
                                    <input type="hidden" id="userId" name="userId" value="{{ $user->id }}">
                                    <input type="hidden" id="count" name="count" value="{{ $shipments->count }}">
                                    <input type="hidden" id="shipment_id" name="shipment_id" value="{{ $shipments->id }}">
                                </form>
                                <form action="{{ route('selects.store') }}" method="POST">
                                    @csrf
                                    <div class="row mb-0">
                                        <div class="col-md-6 offset-md-4">
                                            <button type="submit" class="btn btn-primary">
                                                {{ __('В избранное') }}
                                            </button>
                                        </div>
                                    </div>
                                    <input type="hidden" id="product_id" name="product_id" value="{{ $products->id }}">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- @endsection --}}
@endcan


@can('admin')
    @include('layouts.admin')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    @foreach ($products as $product)
                        <div class="card-header">{{ $product->product_title }}</div>
                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
                            <img src="{{ asset($product->product_image) }}" class="img-thumbnail" width="150px">
                            <a href="{{ route('products.show', $product->id) }}">{{ $product->description }}</a>
                            <ul class="list-unstyled mt-3 mb-4">
                                <li>
                                    <h3><b>{{ $product->shipment->price }} ₽</b></h3>
                                </li>
                            </ul>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endcan
