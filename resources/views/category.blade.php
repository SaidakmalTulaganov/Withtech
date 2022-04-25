@can('admin')
    @include('layouts.admin')
@endcan

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                @foreach ($categories as $category)
                    <div class="card-header"><a
                            href="{{ route('categories.show', $category->id) }}">{{ $category->category_name }}</a>
                    </div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        {{-- <img src="{{ asset($product->product_image) }}" class="img-thumbnail" width="150px">
                        <a href="{{ route('products.show', $product->id) }}">{{ $product->description }}</a>
                        <ul class="list-unstyled mt-3 mb-4">
                            <li>
                                <h3><b>{{ $product->product_price }} ₽</b></h3>
                            </li>
                        </ul> --}}
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
