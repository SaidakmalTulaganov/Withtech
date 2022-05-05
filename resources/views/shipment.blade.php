@can('admin')
    @include('layouts.admin')
@endcan
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
                    <label for="name"
                        class="col-md-4 col-form-label text-md-end">{{ __('Выберите поставщика') }}</label>
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
                    <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Цена') }}</label>

                    <div class="col-md-6">
                        <input id="price" type="text" class="form-control @error('price') is-invalid @enderror"
                            name="price" value="{{ old('price') }}" autocomplete="price" autofocus>

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
                        <input id="count" type="text" class="form-control @error('count') is-invalid @enderror"
                            name="count" value="{{ old('count') }}" autocomplete="count" autofocus>

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
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                @foreach ($shipments as $shipment)
                    <div class="col">
                        <div class="card">
                            <div class="card-header">{{ $shipment->id }}
                                {{-- <a href="{{ route('categories.show', $supplier->id) }}">{{ $supplier->supplier_title }}</a> --}}
                                <aside>
                                    <div class="d-flex flex-column flex-shrink-0">
                                        <div class="row mb-0">
                                            <form action="{{ route('shipments.destroy', $shipment->id) }}"
                                                method="POST">
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
