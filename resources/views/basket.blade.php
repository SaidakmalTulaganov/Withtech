@extends('layouts.app')
<?php $price = 0; ?>
@foreach ($basketProducts as $basketProduct)
    <?php $price = $basketProduct->product->shipment->price * $basketProduct->quantity + $price; ?>
@endforeach

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
    <aside>
        <div class="d-flex flex-column flex-shrink-0 p-3 bg-white shadow-sm" style="width: 280px;">
            <div class="row mb-0">
                <h3><b>Итого: {{ $price }} ₽</b>
                </h3>
                <a href="/orders?price=<?php echo $price; ?>" class="btn btn-primary">
                    {{ __('Перейти к оформлению') }}
                </a>
            </div>
        </div>
    </aside>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    @foreach ($basketProducts as $basketProduct)
                        <div class="card-header">{{ $basketProduct->product->product_title }}
                            <aside>
                                <div class="d-flex flex-column flex-shrink-0">
                                    <div class="row mb-0">
                                        <form action="{{ route('basketProducts.destroy', $basketProduct->product_id) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            {{-- В корзине {{ $basketProduct->quantity }}шт --}}
                                            <a href="{{ route('basketProducts.store', $basketProduct->product_id) }}" class="btn btn-primary bg-white shadow-sm text-secondary">
                                                {{ __('-') }}
                                            </a>
                                            {{ $basketProduct->quantity }}
                                            <a href="{{ route('basketProducts.store', $basketProduct->product_id) }}" class="btn btn-primary bg-white shadow-sm text-secondary">
                                                {{ __('+') }}
                                            </a>
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
                            <img src="{{ asset($basketProduct->product->product_image ?? '') }}" class="img-thumbnail"
                                width="150px">
                            <a
                                href="{{ route('products.show', $basketProduct->product->id ?? '') }}">{{ $basketProduct->product->description ?? '' }}</a>
                            <ul class="list-unstyled mt-3 mb-4">
                                <li>
                                    <h3><b>{{ $basketProduct->product->shipment->price * $basketProduct->quantity }}
                                            ₽</b>
                                    </h3>
                                </li>
                            </ul>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
