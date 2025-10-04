    @extends('layouts.app')
    @section('content')
        <section class="banner">
            <div class="container">
                <div class="row">
                    <div class="inner-banner">
                        <h1 class="banner-title-head">Checkout</h1>
                    </div>
                </div>
        </section>


        <section class="checkout">
            <div class="container">
                <div class="row check-row">
                    <form class="form-horizontal" method="post" id="order-place" role="form"
                        action="{{ route('product.payment') }}">
                        @csrf
                        <input type="hidden" name="payment_id" value="" />
                        <input type="hidden" name="payer_id" value="" />
                        <input type="hidden" name="payment_status" value="" />
                        <input type="hidden" name="payment_method" id="payment_method" value="paypal" />
                        <div class="row">
                            <div class="col-md-8">
                                <div class="row">
                                    <p>Returning to Customer? <a href="#">Click here to login</a></p>
                                    <div class="col-lg-6">
                                        <div class="form-group info-section">
                                            <label for="name">First Name*</label>
                                            <input id="name" name="first_name" type="text" class="form-control"
                                                required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group info-section">
                                            <label for="lname">Last Name*</label>
                                            <input id="lname" name="last_name" type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group info-section">
                                            <label for="email">Email Address*</label>
                                            <input id="email" name="email" type="email" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group info-section">
                                            <label for="phone">Phone*</label>
                                            <input id="phone" name="phone" type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group info-section">
                                            <label for="company">Company Name(Optional)</label>
                                            <input id="company" name="company" type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group info-section">
                                            <label for="country">Country/Region*</label>
                                            <input id="country" name="country" type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group info-section">
                                            <label for="address">Address*</label>
                                            <input id="address" name="address" type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group info-section">
                                            <label for="city">Town/City*</label>
                                            <input id="city" name="town" type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group info-section">
                                            <label for="zip">Postcode/Zip*</label>
                                            <input id="zip" name="zip" type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group info-section">
                                            <label for="check-1" class="check-1"><input id="check-1" name="signin"
                                                    type="checkbox">Sign the up to receive email updates and news
                                                (optional)</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="Your-Order">
                                    <h2 class="text-center">Your Order</h2>
                                    <div class="accordion" id="accordionExample">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                                    data-bs-target="#collapseOne" aria-expanded="true"
                                                    aria-controls="collapseOne">
                                                    Pay with Credit Card
                                                </button>
                                            </h2>
                                            <div id="collapseOne" class="accordion-collapse collapse show"
                                                data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <div class="stripe-form-wrapper require-validation"
                                                        data-stripe-publishable-key="{{ env('STRIPE_KEY') }}"
                                                        data-cc-on-file="false">
                                                        <div id="card-element" class="StripeElement StripeElement--empty">
                                                            <div class="__PrivateStripeElement"
                                                                style="margin: 0px !important; padding: 0px !important; border: none !important; display: block !important; background: transparent !important; position: relative !important; opacity: 1 !important; --stripeElementWidth: 521px;">
                                                                <iframe name="__privateStripeFrame2336" frameborder="0"
                                                                    allowtransparency="true" scrolling="no"
                                                                    role="presentation" allow="payment *"
                                                                    src="https://js.stripe.com/v3/elements-inner-card-40ed1ee1f911278671e9982f316269db.html#wait=false&amp;mids[guid]=NA&amp;mids[muid]=NA&amp;mids[sid]=NA&amp;style[base][color]=%2332325d&amp;style[base][lineHeight]=18px&amp;style[base][fontFamily]=%22Helvetica+Neue%22%2C+Helvetica%2C+sans-serif&amp;style[base][fontSmoothing]=antialiased&amp;style[base][fontSize]=16px&amp;style[base][::placeholder][color]=%23aab7c4&amp;style[invalid][color]=%23fa755a&amp;style[invalid][iconColor]=%23fa755a&amp;rtl=false&amp;componentName=card&amp;keyMode=test&amp;apiKey=pk_test_lkMq1Om8KnexFcuPpAlxrbxe00pfcOxxvr&amp;referrer=https%3A%2F%2Fnewdemowebsites.com%2Fcustom-backend%2Fzapgo%2Fpublic%2FupdateCart&amp;controllerId=__privateStripeController2331"
                                                                    title="Secure card payment input frame"
                                                                    style="border: none !important; margin-top: 0px; margin-right: 0px !important; margin-bottom: 0px !important; margin-left: 0px !important; padding: 0px !important; width: 1px !important; min-width: 100% !important; overflow: hidden !important; display: block !important; user-select: none !important; transform: translate(0px) !important; color-scheme: light only !important; height: 18px;"></iframe><input
                                                                    class="__PrivateStripeElement-input"
                                                                    aria-hidden="true" aria-label=" "
                                                                    autocomplete="false" maxlength="1"
                                                                    style="border: none !important; display: block !important; position: absolute !important; height: 1px !important; top: -1px !important; left: 0px !important; padding: 0px !important; margin: 0px !important; width: 100% !important; opacity: 0 !important; background: transparent !important; pointer-events: none !important; font-size: 16px !important;">
                                                            </div>
                                                        </div>
                                                        <div id="card-errors" role="alert"></div>
                                                        <div class="form-group info-section custom-btn">
                                                            <button class="btn btn-red btn-block blue-custom"
                                                                type="button" id="stripe-submit">Pay Now</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button collapsed" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapseTwo"
                                                    aria-expanded="false" aria-controls="collapseTwo">
                                                    pay with paypal
                                                </button>
                                            </h2>
                                            <div id="collapseTwo" class="accordion-collapse collapse"
                                                data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <div id="paypal-button-container-popup"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button collapsed" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapseThree"
                                                    aria-expanded="false" aria-controls="collapseThree">
                                                    Accordion Item #3
                                                </button>
                                            </h2>
                                            <div id="collapseThree" class="accordion-collapse collapse"
                                                data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <strong>This is the third item's accordion body.</strong> It is hidden
                                                    by default, until the collapse plugin adds the appropriate classes that
                                                    we use to style each element. These classes control the overall
                                                    appearance, as well as the showing and hiding via CSS transitions. You
                                                    can modify any of this with custom CSS or overriding our default
                                                    variables. It's also worth noting that just about any HTML can go within
                                                    the <code>.accordion-body</code>, though the transition does limit
                                                    overflow.
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
        <link rel="stylesheet" href="{{ asset('front/css/checkout.css') }}">

        <style>
            .StripeElement {
                box-sizing: border-box;
                height: 40px;
                padding: 10px 12px;
                border: 1px solid transparent;
                border-radius: 4px;
                background-color: white;
                box-shadow: 0 1px 3px 0 #e6ebf1;
                -webkit-transition: box-shadow 150ms ease;
                transition: box-shadow 150ms ease;
                border-width: 1px;
                border-color: rgb(150, 163, 218);
                border-style: solid;
                margin-bottom: 10px;
            }

            .StripeElement--focus {
                box-shadow: 0 1px 3px 0 #cfd7df;
            }

            .StripeElement--invalid {
                border-color: #fa755a;
            }

            .StripeElement--webkit-autofill {
                background-color: #fefde5 !important;
            }

            .custom-btn {
                padding-top: 30px;
                display: flex;
                justify-content: center;
            }

            .blue-custom {
                background: rgba(13, 110, 253, .25);
                transition: 0.6s;
            }

            .blue-custom:hover {
                background-color: transparent;
                border: 1px solid;
            }
        </style>
    @endpush


    @push('js')
        @include('payment.paypal')

        @include('payment.stripe')
    @endpush
