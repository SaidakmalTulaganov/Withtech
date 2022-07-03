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
        <form method="POST" action="{{ route('states.store') }}">
            @csrf
            <div class="row mb-3">
                <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Статус заказа') }}</label>
                <div class="col-md-6">
                    <input id="title" type="text"
                        class="form-control @error('title') is-invalid @enderror" name="title"
                        value="{{ old('title') }}" autocomplete="title" autofocus>
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
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-3">
            @foreach ($states as $state)
                <div class="col">
                    <div class="card">
                        <div class="card-header"><a
                                href="{{ route('states.show', $state->id) }}">{{ $state->title }}</a>
                            <aside>
                                <div class="d-flex flex-column flex-shrink-0">
                                    <div class="row mb-0">
                                        <form action="{{ route('states.destroy', $state->id) }}" method="POST">
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
