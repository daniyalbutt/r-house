@extends('layouts.app')
@section('content')

    <section class="inner-banner">
        <div class="breadcrumb">
            <div class="container">
                <h2>Shop</h2>
                <ul>
                    <li>Home</li>
                    <li>Shop</li>
                    <li class="active">{{ $product->name }}</li>
                </ul>
            </div>
        </div>
    </section>

    <section class="shop">
        <div class="container">
            <div class="product-detail__wrapper">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="product-detail__slide-two">
                            <div class="product-detail__slide-two__big">
                                <div class="slider__item"><img src="{{ asset($product->image) }}" alt="{{ $product->name }}"/></div>
                                @if (!empty($product->images))
                                    @foreach ($product->images as $img)
                                        <div class="slider__item">
                                            <img src="{{ asset($img) }}" alt="{{ $product->name }}">
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            <div class="product-detail__slide-two__small">
                                <div class="slider__item"><img src="{{ asset($product->image) }}" alt="{{ $product->name }}"/></div>
                                @if (!empty($product->images))
                                    @foreach ($product->images as $img)
                                        <div class="slider__item">
                                            <img src="{{ asset($img) }}" alt="{{ $product->name }}">
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="product-detail__content">
                            <div class="product-detail__content">
                                <div class="product-detail__content__header">
                                    <h5>{{ $product->category->name }}</h5>
                                    <h2>{{ $product->name }}</h2>
                                </div>
                                <div class="product-detail__content__header__comment-block">
                                    <div class="rate"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i></div>
                                    <p>03 review</p>
                                    <a href="#">Write a reviews</a>
                                </div>
                                <h3>${{ $product->price }}</h3>
                                <div class="divider"></div>
                                <div class="product-detail__content__footer">
                                    <ul>
                                        <li>Brand:gucci
                                        </li>
                                        <li>Product code: PM 01
                                        </li>
                                        <li>Reward point: 30
                                        </li>
                                        <li>Availability: In Stock</li>
                                    </ul>
                                    <div class="product-detail__controller">
                                        <div class="quantity-controller -border -round">
                                            <div class="quantity-controller__btn -descrease">-</div>
                                            <div class="quantity-controller__number">2</div>
                                            <div class="quantity-controller__btn -increase">+</div>
                                        </div>
                                        <div class="add-to-cart -dark">
                                            <a class="btn -round -red" href="#"><i class="fas fa-shopping-bag"></i></a>
                                            <h5>Add to cart</h5>
                                        </div>
                                        <div class="product-detail__controler__actions"></div>
                                    </div>
                                    <div class="divider"></div>
                                    <div class="product-detail__content__tab">
                                        <ul class="tab-content__header">
                                            <li class="tab-switcher" data-tab-index="0" tabindex="0">Description</li>
                                        </ul>
                                        <div id="allTabsContainer">
                                            <div class="tab-content__item -description" data-tab-index="0">
                                                {!! $product->description !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="product-slide">
        <div class="container">
            <div class="section-title text-center">
                <h2>Related product</h2>
                <img src="{{ asset('front/images/banner-shape.png') }}" alt="Related product"/>
            </div>
            <div class="product-slider">
                <button class="prev-btn">
                    <img src="{{ asset('front/images/arrow-left.png') }}" alt="">
                </button>
                <div class="product-slide__wrapper">
                    @foreach($relatedProducts as $key => $item)
                    <div class="product-slide__item">
                        <div class="product">
                            @if($item->trending == 1)
                            <div class="product-type">
                                <h5 class="-new">New</h5>
                            </div>
                            @endif
                            <div class="product-thumb">
                                <a class="product-thumb__image" href="{{ route('product.details', $item->slug) }}">
                                    <img src="{{ asset($item->image) }}" alt="{{ $item->name }}"/>
                                    @if (!empty($item->images))
                                    <img src="{{ asset($item->images[0]) }}" alt="{{ $item->name }}"/>
                                    @endif
                                </a>
                                <div class="product-thumb__actions">
                                    <div class="product-btn"><a class="btn -white product__actions__item -round product-atc" href="#"><i class="fas fa-shopping-bag"></i></a>
                                    </div>
                                    <div class="product-btn"><a class="btn -white product__actions__item -round product-qv" href="{{ route('product.details', $item->slug) }}"><i class="fas fa-eye"></i></a>
                                    </div>
                                    <div class="product-btn"><a class="btn -white product__actions__item -round" href="#"><i class="fas fa-heart"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="product-content">
                                <div class="product-content__header">
                                    <div class="product-category">{{ $item->category->name }}</div>
                                </div>
                                <a class="product-name" href="{{ route('product.details', $item->slug) }}">{{ $item->name }}</a>
                                <div class="product-content__footer">
                                    <h5 class="product-price--main">${{ $item->price }}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    </div>
                </div>
                <button class="next-btn">
                    <img src="{{ asset('front/images/arrow-right.png') }}" alt="">
                </button>
            </div>
        </div>
    </section>
    
@endsection

@push('css')
    
@endpush

@push('js')
    
@endpush
