@extends('layouts.app')
@section('content')
<section class="inner-banner">
    <div class="breadcrumb">
        <div class="container">
            <h2>Checkout</h2>
            <ul>
                <li>Home</li>
                <li class="active">Checkout</li>
            </ul>
        </div>
    </div>
</section>

<section class="checkout">
    <div class="container">
        <div class="row check-row">
            <form class="form-horizontal" method="post" id="order-place" role="form"
                action="{{ route('product.payment') }}">
                @csrf

                <!-- Hidden fields -->
                <input type="hidden" name="payment_id" value="">
                <input type="hidden" name="payer_id" value="">
                <input type="hidden" name="payment_status" value="">
                <input type="hidden" name="payment_method" id="payment_method" value="stripe">

                <!-- Add user_id if logged in -->
                @auth
                    <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                @endauth

                <div class="row">
                    <div class="col-md-8">
                        <div class="row">

                            <!-- Only show “Returning Customer?” if NOT logged in -->
                            @guest
                                <div class="col-lg-12 mb-3">
                                    <p>Returning Customer?<br>
                                        <a href="{{ route('login') }}" class="btn btn-theme">Click here to login</a>
                                    </p>
                                </div>
                            @endguest

                            @php
                                // Prefill user details from last order or user profile
                                $user = Auth::user();
                                $lastOrder = $user ? $user->orders()->latest()->first() : null;
                            @endphp

                            <div class="col-lg-6">
                                <div class="form-group info-section">
                                    <label for="name">Name*</label>
                                    <input id="name" name="first_name" type="text" class="form-control" required
                                           value="{{ old('first_name', $lastOrder->first_name ?? ($user->name ?? '')) }}">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group info-section">
                                    <label for="email">Email Address*</label>
                                    <input id="email" name="email" type="email" class="form-control" required
                                           value="{{ old('email', $lastOrder->email ?? ($user->email ?? '')) }}">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group info-section">
                                    <label for="phone">Phone*</label>
                                    <input id="phone" name="phone" type="text" class="form-control" required
                                           value="{{ old('phone', $lastOrder->phone ?? '') }}">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group info-section">
                                    <label for="country">Country/Region*</label>
                                    <input id="country" name="country" type="text" class="form-control" required
                                           value="{{ old('country', $lastOrder->country ?? '') }}">
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group info-section">
                                    <label for="address">Address*</label>
                                    <input id="address" name="address" type="text" class="form-control" required
                                           value="{{ old('address', $lastOrder->address ?? '') }}">
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group info-section">
                                    <label for="city">Town/City*</label>
                                    <input id="city" name="town" type="text" class="form-control" required
                                           value="{{ old('town', $lastOrder->town ?? '') }}">
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group info-section">
                                    <label for="zip">Postcode/Zip*</label>
                                    <input id="zip" name="zip" type="text" class="form-control" required
                                           value="{{ old('zip', $lastOrder->zip ?? '') }}">
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group info-section">
                                    <label for="check-1" class="check-1">
                                        <input id="check-1" name="signin" type="checkbox">
                                        Sign up to receive email updates and news (optional)
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Order Summary -->
                    <div class="col-md-4">
                        <div class="checkout__total">
                            <h5 class="checkout-title">Your order</h5>
                            <div class="checkout__total__price">
                                <h5>Product</h5>
                                <table class="table mb-2">
                                    <colgroup>
                                        <col style="width: 60%" />
                                        <col style="width: 40%" />
                                    </colgroup>
                                    <tbody>
                                        @foreach($cart as $item)
                                            <tr class="product-info">
                                                <td>
                                                    <span>{{ $item['quantity'] }} × </span>{{ $item['name'] }}
                                                    @if(!empty($item['attributes']))
                                                        <br>
                                                        @foreach($item['attributes'] as $attr)
                                                            {{ $attr['value'] }}@if(!$loop->last), @endif
                                                        @endforeach
                                                    @endif
                                                </td>
                                                <td>${{ number_format($item['final_price'] * $item['quantity'], 2) }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="checkout__total__price__total-count">
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td>Total</td>
                                                <td>${{ number_format($grandTotal, 2) }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="checkout__total__price__payment">
                                    <div class="stripe-form-wrapper require-validation"
                                         data-stripe-publishable-key="{{ env('STRIPE_KEY') }}"
                                         data-cc-on-file="false">
                                        <div id="card-element"></div>
                                        <div id="card-errors" role="alert"></div>
                                        <div class="form-group info-section custom-btn mb-0">
                                            <button class="btn btn-red btn-block btn-theme" type="button" id="stripe-submit">
                                                Pay Now
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection

@push('css')
<style>
    .StripeElement {
        box-sizing: border-box;
        height: 40px;
        padding: 10px 12px;
        border: 1px solid #ced4da;
        border-radius: 4px;
        background-color: white;
        box-shadow: 0 1px 3px 0 #e6ebf1;
        transition: box-shadow 150ms ease;
        margin-bottom: 10px;
    }
    .StripeElement--focus { box-shadow: 0 1px 3px 0 #cfd7df; }
    .StripeElement--invalid { border-color: #f5c6cb; }
    .StripeElement--webkit-autofill { background-color: #fefde5 !important; }
</style>
@endpush

@push('js')
@include('payment.paypal')
@include('payment.stripe')
@endpush
