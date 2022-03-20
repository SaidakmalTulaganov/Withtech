@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Оформление заказа') }}</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('orders.store') }}">
                            @csrf
                            <div class="row mb-3">
                                <label for="delivery_address"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Адрес доставки') }}</label>
                                <div class="col-md-6">
                                    <input id="delivery_address" type="text"
                                        class="form-control 
                                        @error('delivery_address') is-invalid @enderror"
                                        name="delivery_address" value="{{ old('delivery_address') }}" required
                                        autocomplete="delivery_address" autofocus>

                                    @error('delivery_address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="OrderStep__container">
                                <div class="OrderStep__header">
                                    <h3 class="OrderStep__title" role="presentation">
                                        <span class="OrderStep__number">
                                        </span>
                                        <span>Подтверждение и оплата
                                        </span>
                                    </h3>
                                </div>
                                <div class="OrderStep__content">
                                    <div class="ConfirmationPayment">
                                        <div class="B2CPaymentLayout">
                                            <div class="B2CPaymentLayout__payment-types">
                                                <div class="OrderSection">
                                                    <div class="OrderSection__header">
                                                        <div class="OrderSection__title">Выберите способ оплаты
                                                        </div>
                                                    </div>
                                                    <div class="OrderSection__content">
                                                        <div class="RadioGroup RadioGroup_horizontal_gapped">
                                                            <label class="RadioButton Radio">
                                                                <span class="Radio__input InputBox InputBox_type_radio">
                                                                    <input class="InputBox__input" type="radio"
                                                                        name="paymentType" value="Наличными или картой при получении" checked="">
                                                                    <span class="InputBox__checkmark" hidden="">
                                                                    </span>
                                                                </span>
                                                                <span class="Radio__label">Наличными или картой при
                                                                    получении
                                                                </span>
                                                            </label>
                                                            <label class="RadioButton Radio">
                                                                <span class="Radio__input InputBox InputBox_type_radio">
                                                                    <input class="InputBox__input" type="radio"
                                                                        name="paymentType" value="Банковской картой онлайн">
                                                                    <span class="InputBox__checkmark" hidden="">
                                                                    </span>
                                                                </span>
                                                                <span class="Radio__label">Банковской картой
                                                                    онлайн
                                                                </span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="B2CPaymentLayout__contact-for-check">
                                                <div name="CONTACT_FOR_CHECK" class="OrderStep">
                                                    <div class="ContactForCheckLayout">
                                                        <div class="ContactForCheckLayout__emailOrSms">
                                                            <div class="OrderSection">
                                                                <div class="OrderSection__header">
                                                                    <div class="OrderSection__title">Получить чек по:
                                                                    </div>
                                                                </div>
                                                                <div class="OrderSection__content">
                                                                    <div
                                                                        class="RadioGroup RadioGroup_horizontal RadioGroup_force_mobile_horizontal">
                                                                        <label class="RadioButton Radio Radio_checked">
                                                                            <span
                                                                                class="Radio__input InputBox InputBox_type_radio InputBox_checked">
                                                                                <input class="InputBox__input" type="radio"
                                                                                    name="email_or_phone" value="email"
                                                                                    checked="">
                                                                                <span class="InputBox__checkmark" hidden="">
                                                                                </span>
                                                                            </span>
                                                                            <span class="Radio__label">Email
                                                                            </span>
                                                                        </label>
                                                                        <label class="RadioButton Radio">
                                                                            <span
                                                                                class="Radio__input InputBox InputBox_type_radio">
                                                                                <input class="InputBox__input" type="radio"
                                                                                    name="email_or_phone" value="phone">
                                                                                <span class="InputBox__checkmark" hidden="">
                                                                                </span>
                                                                            </span>
                                                                            <span class="Radio__label">SMS
                                                                            </span>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- <div class="PaymentLayoutBottom__submit">
                                        <button
                                            class="B2CPaymentLayout__submit-element SubmitButton buttonStyleDecorator_disabled buttonStyleDecorator buttonStyleDecorator_theme_primary buttonStyleDecorator_size_l Button"
                                            name="" type="submit" value="" tabindex="0">
                                            <span class="buttonStyleDecorator__text ">Оплатить
                                            </span>
                                        </button>
                                    </div> --}}
                                </div>
                            </div>
                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Оплатить') }}
                                    </button>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>
    </div>
    </div>
    </div>
@endsection
