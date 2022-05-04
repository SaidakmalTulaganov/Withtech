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
            <div class="col-md-8">
                <form method="POST" action="{{ route('productsadmin.store') }}">
                    @csrf
                    <div class="row mb-3">
                        <label for="name"
                            class="col-md-4 col-form-label text-md-end">{{ __('Выберите категорию') }}</label>
                        <div class="col-md-6">
                            <select class="form-select" aria-label="Disabled select example" type="inputGroupSelect01"
                                name="category_id">
                                {{-- <option selected>Поставщики</option> --}}
                                @foreach ($categories as $category)
                                    <option name="category_id" value="{{ $category->id }}">
                                        {{ $category->category_name }}</option>
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
                        <label for="name"
                            class="col-md-4 col-form-label text-md-end">{{ __('Выберите производителя') }}</label>
                        <div class="col-md-6">
                            <select class="form-select" aria-label="Disabled select example" type="inputGroupSelect01"
                                name="manufacturer_id">
                                {{-- <option selected>Поставщики</option> --}}
                                @foreach ($manufacturers as $manufacturer)
                                    <option name="manufacturer_id" value="{{ $manufacturer->id }}">
                                        {{ $manufacturer->manufacturer_name }}</option>
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
                        <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Выберите партию') }}</label>
                        <div class="col-md-6">
                            <select class="form-select" aria-label="Disabled select example" type="inputGroupSelect01"
                                name="shipment_id">
                                {{-- <option selected>Поставщики</option> --}}
                                @foreach ($shipments as $shipment)
                                    <option name="manufacturer_id" value="{{ $shipment->id }}">
                                        {{ $shipment->count }} шт. по {{ $shipment->price }} ₽, дата поставки
                                        {{ $shipment->datetime }}
                                    </option>
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
                        <label for="name"
                            class="col-md-4 col-form-label text-md-end">{{ __('Наименование товара') }}</label>

                        <div class="col-md-6">
                            <input id="product_title" type="text"
                                class="form-control @error('product_title') is-invalid @enderror" name="product_title"
                                value="{{ old('product_title') }}" autocomplete="product_title" autofocus>

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
                        <label for="name"
                            class="col-md-4 col-form-label text-md-end">{{ __('Описание к товару') }}</label>

                        <div class="col-md-6">
                            <input id="description" type="text"
                                class="form-control @error('description') is-invalid @enderror" name="description"
                                value="{{ old('description') }}" autocomplete="description" autofocus>

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
                        <label for="name"
                            class="col-md-4 col-form-label text-md-end">{{ __('Изображение к товару') }}</label>

                        <div class="col-md-6">
                            <input id="product_image" type="text"
                                class="form-control @error('product_image') is-invalid @enderror" name="product_image"
                                value="{{ old('product_image') }}" autocomplete="product_image" autofocus>

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
                <div class="card">
                    @foreach ($products as $product)
                        <div class="card-header">{{ $product->product_title }}
                            <aside>
                                <div class="d-flex flex-column flex-shrink-0">
                                    <div class="row mb-0">
                                        <form action="{{ route('productsadmin.destroy', $shipment->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            Осталось {{ $product->shipment->count }} шт.
                                            {{-- <button class="btn btn-primary">
                                                {{ __('Характеристики') }}
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
                            <img src="{{ asset($product->product_image) }}" class="img-thumbnail" width="150px">
                            <a href="{{ route('productsadmin.show', $product->id) }}">{{ $product->description }}</a>
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
@endsection
