@extends('layouts.app')

@section('content')
<div class="container">
    {{-- <?php $user = auth()->user(); 
    echo $user->id;
    echo $user->name;
    echo $user->email;
    ?> --}}
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                @foreach ($products as $product)
                <div class="card-header">{{ $product->product_title }}</div>
                    {{-- <li>{{ $product->id }} {{ $product->category->category_name ?? '' }} {{ $product->manufacturer->manufacturer_name ?? '' }} {{ $product->product_title }} {{ $product->description }} {{ $product->product_price }}</li> --}}
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <img src="{{ asset($product->product_image) }}" class="img-thumbnail" width="150px">
                        <a href="{{ route('products.show', $product->id) }}">{{ $product->description }}</a>
                        <ul class="list-unstyled mt-3 mb-4">
                            <li><h3><b>{{ $product->product_price }}</b></h3></li>
                        </ul>
                        {{-- <a class="w-100 btn btn-lg btn-outline-primary" href="/product.php?id={{ $product->id }}">В корзину</a> --}}
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
