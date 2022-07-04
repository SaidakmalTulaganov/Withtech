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
            <form method="POST" action="{{ route('suppliers.store') }}">
                @csrf
                <div class="row mb-3">
                    <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Поставщик') }}</label>
    
                    <div class="col-md-6">
                        <input id="supplier_title" type="text"
                            class="form-control @error('supplier_title') is-invalid @enderror" name="supplier_title"
                            value="{{ old('supplier_title') }}" autocomplete="supplier_title" autofocus>
    
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
                @foreach ($suppliers as $supplier)
                    <div class="col">
                        <div class="card">
                            <div class="card-header">{{ $supplier->supplier_title }}
                                <aside>
                                    <div class="d-flex flex-column flex-shrink-0">
                                        <div class="row mb-0">
                                            <form action="{{ route('suppliers.destroy', $supplier->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
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
            {{-- <div class="col-md-8"> --}}
            <form method="POST" action="{{ route('suppliers.store') }}">
                @csrf
                <div class="row mb-3">
                    <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Поставщик') }}</label>
    
                    <div class="col-md-6">
                        <input id="supplier_title" type="text"
                            class="form-control @error('supplier_title') is-invalid @enderror" name="supplier_title"
                            value="{{ old('supplier_title') }}" autocomplete="supplier_title" autofocus>
    
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
                @foreach ($suppliers as $supplier)
                    <div class="col">
                        <div class="card">
                            <div class="card-header">{{ $supplier->supplier_title }}
                                {{-- <a href="{{ route('categories.show', $supplier->id) }}">{{ $supplier->supplier_title }}</a> --}}
                                <aside>
                                    <div class="d-flex flex-column flex-shrink-0">
                                        <div class="row mb-0">
                                            <form action="{{ route('suppliers.destroy', $supplier->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
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
