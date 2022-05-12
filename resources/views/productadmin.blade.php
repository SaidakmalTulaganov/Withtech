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
            <form method="POST" action="{{ route('productsadmin.store') }}">
                @csrf
                <div class="row mb-3">
                    <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Выберите категорию') }}</label>
                    <div class="col-md-6">
                        <select class="form-select" aria-label="Disabled select example" type="inputGroupSelect01"
                            name="category_id">
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
                    <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Наименование товара') }}</label>

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
                    <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Описание к товару') }}</label>

                    <div class="col-md-6">
                        <input id="description" type="text" class="form-control @error('description') is-invalid @enderror"
                            name="description" value="{{ old('description') }}" autocomplete="description" autofocus>

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
                <div class="row mb-3">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Добавить') }}
                        </button>
                    </div>
                </div>
            </form>
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                {{-- @foreach ($products as $product)
                    <div class="col">
                        <div class="card">
                            <div class="card-header">{{ $product->product_title }}
                                <aside>
                                    <div class="d-flex flex-column flex-shrink-0">
                                        <div class="row mb-0">
                                            <form action="{{ route('productsadmin.destroy', $shipment->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                Осталось {{ $product->shipment->count }} шт.
                                                <button class="btn btn-primary">
                                                    {{ __('Характеристики') }}
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </aside>
                            </div>
                            <div class="card-body" style="min-height: 45em">
                                @if (session('status'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @endif
                                <div style="min-height: 30em">
                                    <img src="{{ asset($product->product_image) }}" class="img-thumbnail">
                                </div>
                                <b>{{ $product->shipment->price }} ₽</b>
                                <ul class="list-unstyled mt-3 mb-4">
                                    <li>
                                        <a
                                            href="{{ route('productsadmin.show', $product->id) }}">{{ $product->description }}</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                @endforeach --}}
                @foreach ($shipments as $shipment)
                    <div class="col">
                        <div class="card">
                            <div class="card-header">{{ $shipment->product->product_title }}
                                <aside>
                                    <div class="d-flex flex-column flex-shrink-0">
                                        <div class="row mb-0">
                                            <form action="{{ route('productsadmin.destroy', $shipment->product_id) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                Осталось {{ $shipment->count }} шт.
                                                {{-- <button class="btn btn-primary">
                                                    {{ __('Задать характеристики') }}
                                                </button> --}}
                                            </form>
                                        </div>
                                    </div>
                                </aside>
                            </div>
                            <div class="card-body" style="min-height: 45em">
                                @if (session('status'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @endif
                                <div style="min-height: 30em">
                                    <img src="{{ asset($shipment->product->product_image) }}" class="img-thumbnail">
                                </div>
                                <b>{{ $shipment->price }} ₽</b>
                                <ul class="list-unstyled mt-3 mb-4">
                                    <li>
                                        <a
                                            href="{{ route('productsadmin.show', $shipment->id) }}">{{ $shipment->product->description }}</a>
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
