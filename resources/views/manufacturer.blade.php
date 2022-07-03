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
        <form method="POST" action="{{ route('manufacturers.store') }}">
            @csrf
            <div class="row mb-3">
                <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Производитель') }}</label>

                <div class="col-md-6">
                    <input id="manufacturer_name" type="text"
                        class="form-control @error('manufacturer_name') is-invalid @enderror" name="manufacturer_name"
                        value="{{ old('manufacturer_name') }}" required autocomplete="manufacturer_name" autofocus>

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
            @foreach ($manufacturers as $manufacturer)
                <div class="col">
                    <div class="card">
                        <div class="card-header"><a
                                href="{{ route('manufacturers.show', $manufacturer->id) }}">{{ $manufacturer->manufacturer_name }}</a>
                            <aside>
                                <div class="d-flex flex-column flex-shrink-0">
                                    <div class="row mb-0">
                                        <form action="{{ route('manufacturers.destroy', $manufacturer->id) }}"
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
