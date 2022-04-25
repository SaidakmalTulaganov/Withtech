@extends('layouts.app')

@section('content')
    <?php $user = auth()->user();
    ?>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ $products->product_title }}</div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <img src="{{ asset($products->product_image) }}" class="img-thumbnail" width="250px">
                        <h3>{{ $products->description }}</h3>
                        <ul class="list-unstyled mt-3 mb-4">
                            <li>
                                <h3><b>{{ $products->product_price }} ₽</b></h3>
                            </li>
                        </ul>
                        <div class="js--ProductHeader__count-selector-container ProductHeader__count-selector-container">
                            <div id=""
                                class="ProductHeader__count-selector js--ProductHeader__count-selector CountSelector js--CountSelector">
                                <form action="{{ route('products.store') }}" method="POST">
                                    @csrf
                                    <div class="row mb-0">
                                        <div class="col-md-6 offset-md-4">
                                            <button type="submit" class="btn btn-primary">
                                                {{ __('В корзину') }}
                                            </button>
                                            <input class="js--CountSelector__input CountSelector__input" type="number"
                                                value="1" min="1" max="50" step="1" data-step="1" required=""
                                                name="quantity">
                                        </div>
                                    </div>
                                    <input type="hidden" id="productId" name="productId" value="{{ $products->id }}">
                                    <input type="hidden" id="userId" name="userId" value="{{ $user->id }}">
                                    <input type="hidden" id="count" name="count" value="{{ $products->count }}">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
