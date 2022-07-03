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
            {{-- <div class="col-md-8"> --}}
            <form method="POST" action="{{ route('shipments.store') }}">
                @csrf
                <div class="row mb-3">
                    <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Выберите поставщика') }}</label>
                    <div class="col-md-6">
                        <select class="form-select" aria-label="Disabled select example" type="inputGroupSelect01"
                            name="supplier_id">
                            {{-- <option selected>Поставщики</option> --}}
                            @foreach ($suppliers as $supplier)
                                <option name="supplier_id" value="{{ $supplier->id }}">
                                    {{ $supplier->supplier_title }}</option>
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
                    <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Выберите товар') }}</label>
                    <div class="col-md-6">
                        <select class="form-select" aria-label="Disabled select example" type="inputGroupSelect01"
                            name="product_id">
                            {{-- <option selected>Поставщики</option> --}}
                            @foreach ($products as $product)
                                <option name="product_id" value="{{ $product->id }}">
                                    {{ $product->product_title }}</option>
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
                    <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Запукочная цена') }}</label>

                    <div class="col-md-6">
                        <input id="purchase_price" type="text"
                            class="form-control @error('purchase_price') is-invalid @enderror" name="purchase_price"
                            value="{{ old('purchase_price') }}" autocomplete="purchase_price" autofocus>

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
                    <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Цена для продаж') }}</label>

                    <div class="col-md-6">
                        <input id="selling_price" type="text"
                            class="form-control @error('selling_price') is-invalid @enderror" name="selling_price"
                            value="{{ old('selling_price') }}" autocomplete="selling_price" autofocus>

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
                    <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Количество') }}</label>

                    <div class="col-md-6">
                        <input id="count" type="text" class="form-control @error('count') is-invalid @enderror" name="count"
                            value="{{ old('count') }}" autocomplete="count" autofocus>

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
                <div class="row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Добавить') }}
                        </button>
                    </div>
                </div>
            </form>
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-3">
                @foreach ($shipments as $shipment)
                    <div class="col">
                        <div class="card">
                            <div class="card-header">{{ $shipment->id }}
                                {{-- <a href="{{ route('categories.show', $supplier->id) }}">{{ $supplier->supplier_title }}</a> --}}
                                <aside>
                                    <div class="d-flex flex-column flex-shrink-0">
                                        <div class="row mb-0">
                                            <form action="{{ route('shipments.destroy', $shipment->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                {{-- <a href="{{ route('basketProducts.store', $basketProduct->product_id) }}"
                                                class="btn btn-primary bg-white shadow-sm text-secondary">
                                                {{ __('-') }}
                                            </a>
                                            {{ $basketProduct->quantity }}
                                            <a href="{{ route('basketProducts.store', $basketProduct->product_id) }}"
                                                class="btn btn-primary bg-white shadow-sm text-secondary">
                                                {{ __('+') }}
                                            </a> --}}
                                                <button class="btn btn-primary">
                                                    {{ __('Удалить') }}
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
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            {{-- </div> --}}
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
            <form action="{{ route('shipments.export') }}" method="POST">
                @csrf
                @method('GET')
                <div class="row mb-0">
                    <div class="col-md-6 offset-md-4">
                        Выгрузить отчет по всем партиям
                        <button type="submit" class="btn btn-primary">
                            {{ __('Выгрузить') }}
                        </button>
                    </div>
                </div>
            </form>
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                @foreach ($shipments as $shipment)
                    <div class="col">
                        <div class="card">
                            <div class="card-header"> Партия №: {{ $shipment->id }} от {{ $shipment->datetime }}
                            </div>
                            <div class="card-body">
                                @if (session('status'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @endif
                                <ul class="list-unstyled mt-3 mb-4">
                                    <li>
                                        <b>Поставщик: {{ $shipment->supplier->supplier_title }}</b>
                                    </li>
                                    <li>
                                        <b>Категория товара: {{ $shipment->product->category->category_name }}</b>
                                    </li>
                                    <li>
                                        <b>Товар: {{ $shipment->product->product_title }}</b>
                                    </li>
                                    <li>
                                        <b>Закупочная цена: {{ $shipment->purchase_price }} ₽</b>
                                    </li>
                                    <li>
                                        <b>Цена для продаж: {{ $shipment->selling_price }} ₽</b>
                                    </li>
                                    <li>
                                        <b>Количество: {{ $shipment->count }}</b>
                                    </li>
                                </ul>
                                {{-- <form action="{{ route('shipments.export') }}" method="POST">
                                    @csrf
                                    @method('GET')
                                    <div class="row mb-0">
                                        <div class="col-md-6 offset-md-4">
                                            <button type="submit" class="btn btn-primary">
                                                {{ __('Выгрузить') }}
                                            </button>
                                        </div>
                                    </div>
                                    <input type="hidden" id="shipment" name="shipment"
                                        value="{{ $shipment->id }}">
                                    <input type="hidden" id="supplier" name="supplier"
                                        value="{{ $shipment->supplier->supplier_title }}">
                                    <input type="hidden" id="category" name="category"
                                        value="{{ $shipment->product->category->category_name }}">
                                    <input type="hidden" id="product" name="product"
                                        value="{{ $shipment->product->product_title }}">
                                    <input type="hidden" id="purchase" name="purchase"
                                        value="{{ $shipment->purchase_price }}">
                                    <input type="hidden" id="selling" name="selling"
                                        value="{{ $shipment->selling_price }}">
                                    <input type="hidden" id="count" name="count" value="{{ $shipment->count }}">
                                    <input type="hidden" id="datetime" name="datetime" value="{{ $shipment->datetime }}">
                                </form> --}}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endcan
