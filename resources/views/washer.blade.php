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

        /* Стили таблицы (IKSWEB) */
        table.iksweb {
            text-decoration: none;
            border-collapse: collapse;
            width: 400px;
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
                                            <td>Класс стирки</td>
                                            <td>{{ $characteristic->wash_class }}</td>
                                        </tr>
                                        <tr>
                                            <td>Класс отжима</td>
                                            <td>{{ $characteristic->spin_class }}</td>
                                        </tr>
                                        <tr>
                                            <td>Материал барабана</td>
                                            <td>{{ $characteristic->drum_material }}</td>
                                        </tr>
                                        <tr>
                                            <td>Максимальная загрузка</td>
                                            <td>{{ $characteristic->maximum_load }} кг</td>
                                        </tr>
                                        <tr>
                                            <td>Максимальная скорость отжима</td>
                                            <td>{{ $characteristic->spin_speed }} об/мин</td>
                                        </tr>
                                        <tr>
                                            <td>Расход воды</td>
                                            <td>{{ $characteristic->water_consumption }} л</td>
                                        </tr>
                                        <tr>
                                            <td>Объем барабана</td>
                                            <td>{{ $characteristic->drum_volume }} л</td>
                                        </tr>
                                        <tr>
                                            <td>Количество программ</td>
                                            <td>{{ $characteristic->number_programs }}</td>
                                        </tr>
                                        <tr>
                                            <td>Программы</td>
                                            <td>{{ $characteristic->programs }}</td>
                                        </tr>
                                        <tr>
                                            <td>Цвет</td>
                                            <td>{{ $characteristic->color }}</td>
                                        </tr>
                                        <tr>
                                            <td>Вес (нетто)</td>
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
@endcan
@can('client')
    @include('layouts.app')
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
    {{-- <aside>
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
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-5 g-3">
                <div class="col">
                    <div class="d-flex flex-column flex-shrink-0 p-3 bg-white shadow-sm">
                        <div class="row mb-0">
                            <?php $price_up = 1;
                            $price_down = 0;
                            $name_up = 3;
                            $name_down = 2; ?>
                            по цене
                            <div class="col">
                                <form action="{{ route('washingmachines.show', $price_up) }}" method="POST">
                                    @csrf
                                    @method('GET')
                                    <button class="btn btn-primary bg-white shadow-sm text-secondary">
                                        &#9650;
                                    </button>
                                    {{-- <input type="hidden" id="count" name="count" value="1"> --}}
                                </form>
                            </div>
                            <div class="col">
                                <form action="{{ route('washingmachines.show', $price_down) }}" method="POST">
                                    @csrf
                                    @method('GET')
                                    <button class="btn btn-primary bg-white shadow-sm text-secondary">
                                        &#9660;
                                    </button>
                                    {{-- <input type="hidden" id="count" name="count" value="0"> --}}
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="d-flex flex-column flex-shrink-0 p-3 bg-white shadow-sm">
                        <div class="row mb-0">
                            по названию
                            <div class="col">
                                <form action="{{ route('washingmachines.show', $name_up) }}" method="POST">
                                    @csrf
                                    @method('GET')
                                    <button class="btn btn-primary bg-white shadow-sm text-secondary">
                                        &#9650;
                                    </button>
                                    {{-- <input type="hidden" id="count" name="count" value="1"> --}}
                                </form>
                            </div>
                            <div class="col">
                                <form action="{{ route('washingmachines.show', $name_down) }}" method="POST">
                                    @csrf
                                    @method('GET')
                                    <button class="btn btn-primary bg-white shadow-sm text-secondary">
                                        &#9660;
                                    </button>
                                    {{-- <input type="hidden" id="count" name="count" value="0"> --}}
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-5 g-3">
                @foreach ($shipments as $shipment)
                    <div class="col">
                        <div class="card">
                            <div class="card-header">{{ $shipment->product_title }}</div>
                            <div class="card-body">
                                @if (session('status'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @endif
                                <div>
                                    <img src="{{ asset($shipment->product_image) }}" height="300">
                                </div>
                                <a href="{{ route('products.show', $shipment->id) }}">{{ $shipment->description }}</a>
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
@endcan
