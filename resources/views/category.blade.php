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
        <div class="col-md-8">
            <form method="POST" action="{{ route('categories.store') }}">
                @csrf
                <div class="row mb-3">
                    <label for="name"
                        class="col-md-4 col-form-label text-md-end">{{ __('Название категории') }}</label>

                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                            value="{{ old('name') }}" required autocomplete="name" autofocus>

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
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
                @foreach ($categories as $category)
                    <div class="card-header"><a
                            href="{{ route('categories.show', $category->id) }}">{{ $category->category_name }}</a>
                        <aside>
                            <div class="d-flex flex-column flex-shrink-0">
                                <div class="row mb-0">
                                    <form action="{{ route('categories.destroy', $category->id) }}" method="POST">
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
                @endforeach
            </div>
        </div>
    </div>
</div>
