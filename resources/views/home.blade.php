{{-- @if ()
    
@else
    
@endif --}}
<?php 
Gate::allows('client');
?>
@extends('layouts.app')

@section('content')
    {{-- <style>
        aside {
            /* width: 280px; */
            float: right;
        }

        article {
            margin-right: 240px;
            display: block;
        }

    </style>
    <aside>
        <div class="d-flex flex-column flex-shrink-0 p-3 bg-white shadow-sm">
            <div class="row mb-0">
                <h3><b>Итого: {{ $price }} ₽</b>
                </h3>
                <a href="{{ route('home.show', $product->id) }}" class="btn btn-primary">
                    {{ __('по цене') }}
                </a>
            </div>
        </div>
    </aside> --}}
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    @foreach ($products as $product)
                        <div class="card-header">{{ $product->product_title }}</div>
                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
                            <img src="{{ asset($product->product_image) }}" class="img-thumbnail" width="150px">
                            <a href="{{ route('products.show', $product->id) }}">{{ $product->description }}</a>
                            <ul class="list-unstyled mt-3 mb-4">
                                <li>
                                    <h3><b>{{ $product->product_price }} ₽</b></h3>
                                </li>
                            </ul>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
