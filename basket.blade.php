@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    @foreach ($basketProducts as $basketProduct)
                        <div class="card-header">{{ $basketProduct->product->product_title ?? '' }}</div>
                        {{-- <li>{{ $product->id }} {{ $product->category->category_name ?? '' }} {{ $product->manufacturer->manufacturer_name ?? '' }} {{ $product->product_title }} {{ $product->description }} {{ $product->product_price }}</li> --}}
                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
                            <img src="{{ asset($basketProduct->product->product_image ?? '') }}" class="img-thumbnail"
                                width="150px">
                            <a
                                href="{{ route('products.show', $basketProduct->product->id ?? '') }}">{{ $basketProduct->product->description ?? '' }}</a>
                            <ul class="list-unstyled mt-3 mb-4">
                                <li>
                                    <h3><b>{{ $basketProduct->product->product_price ?? '' }}</b></h3>
                                </li>
                            </ul>
                        </div>
                    @endforeach
                    <div class="row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <a href="{{ route('orders.index') }}" type="submit" class="btn btn-primary" href="">
                                {{ __('Перейти к оформлению') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
