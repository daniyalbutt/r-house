@extends('layouts.app')
@section('content')
    <section class="banner">
        <div class="container">
            <div class="row">
                <div class="inner-banner">
                    <h1 class="banner-title-head">Shop Detail</h1>
                </div>
            </div>
    </section>

    <div id="content-wrapper">
        <div class="column">
            <div id="img-container">
                <div id="lens"></div>
                <img id=featured src="{{ asset($product->image) }}">
            </div>
            <div id="slide-wrapper">
                <img id="slideLeft" class="arrow" src="{{ asset('admin/image/arrow-left.png') }}">

                <div id="slider">
                    @foreach ($product->images as $key => $image)
                        <img class="thumbnail" src="{{ asset($image) }}">
                    @endforeach
                </div>





                <img id="slideRight" class="arrow" src="{{ asset('admin/image/arrow-right.png') }}">
            </div>
        </div>

        <div class="column">
            <h1>Category: {{ $product->category->name }} </h1>
            <h1>{{ $product->name }}</h1>
            <hr>
            <h4>
                Discount:
                @if ($product->discount == 0)
                    No Discount Available.
                @else
                    <del>${{ number_format($product->price) }}</del>
                    ({{ $product->discount }}% off)
                @endif

            </h4>
            <h4>
                Stock: {{ $product->stock }}
            </h4>
            <hr>
            <h3>
                Price :
                ${{ $product->discount == 0 ? number_format($product->price) : number_format($product->price - $product->price * ($product->discount / 100)) }}

            </h3>
            <hr>
            <div class="detail-content">
                <h4>
                    Description:
                </h4>
                <p>{!! $product->description !!}</p>
            </div>
            <hr>
            <div class="ratings">
                <p>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>


                    (15 reviews)
                </p>
            </div>

            <div class="wrapper-btn">
                <span class="qty text">Qty:</span>
                <span class="qty minus">-</span>
                <input class="qty-value" id="input-qty" value="1" type="number" min="1"
                    max="{{ $product->stock }}" maxlength="3" required>
                <span class="qty plus">+</span>
                <a class="btn cart-btn" href="#">Add to Cart</a>
            </div>


        </div>

    </div>
@endsection

@push('css')
    <link rel="stylesheet" href="{{ asset('front/css/shop-detail.css') }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400..700;1,400..700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
@endpush

@push('js')
    <script src="{{ asset('front/js/slider.js') }}"></script>
    <script src="{{ asset('front/js/script.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
@endpush
