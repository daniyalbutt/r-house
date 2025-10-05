@extends('layouts.app')
@section('content')
    <section class="banner home-banner">
        <div class="swiper mySwiper">
            <div class="swiper-wrapper">
                @foreach($banners as $key => $value)
                <div class="swiper-slide" style="background-image:url('{{ asset($value->image) }}');">
                    <div class="content">
                        <div class="express">{{ $value->title }}</div>
                        <div class="colors">{{ $value->subtitle }}</div>
                        <div class="bottom-text">{{ $value->description }}</div>
                        <div class="shape">
                            <img src="{{ asset('front/images/banner-shape.png') }}" alt="">
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="swiper-button-next home-swiper-button-next"></div>
            <div class="swiper-button-prev home-swiper-button-prev"></div>
        </div>
    </section>
    
    @php
    $categories = \App\Models\Category::where('parent_id', 0)->where('status', 0)->get();
    $leftCategories = $categories->take(2);
    $rightCategories = $categories->skip(2);
    @endphp
    
    <section class="categories container">
        <div class="row">
            {{-- LEFT COLUMN (first 2 categories) --}}
            <div class="col-md-6">
                @foreach($leftCategories as $category)
                    <div class="img-box mb-4">
                        <img src="{{ asset($category->image) }}" alt="{{ $category->name }}">
                        <div class="desktop">
                            <h5>{{ $category->name }}</h5>
                        </div>
                        <div class="overlay">
                            <h5>{{ $category->name }}</h5>
                            {!! $category->description !!}
                        </div>
                    </div>
                @endforeach
            </div>
    
            {{-- RIGHT COLUMN (remaining categories) --}}
            <div class="col-md-6">
                <div class="row">
                    @foreach($rightCategories as $key => $category)
                        {{-- Make first one full width like your example --}}
                        @if($loop->first)
                            <div class="col-12">
                                <div class="img-box">
                                    <img src="{{ asset($category->image) }}" alt="{{ $category->name }}">
                                    <div class="desktop">
                                        <h5>{{ $category->name }}</h5>
                                    </div>
                                    <div class="overlay">
                                        <h5>{{ $category->name }}</h5>
                                        {!! $category->description !!}
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="col-6">
                                <div class="img-box lower-img-box mb-4">
                                    <img src="{{ asset($category->image) }}" alt="{{ $category->name }}">
                                    <div class="desktop">
                                        <h5>{{ $category->name }}</h5>
                                    </div>
                                    <div class="overlay">
                                        <h5>{{ $category->name }}</h5>
                                        {!! $category->description !!}
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    
    <section class="featured-product-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="featured-product">
                        <div class="featured-image">
                            <a href="#">
                                <img src="https://samplelinkweb.site/custom-html/r-house/v2/img/featured-image-1.jpg">
                                <span class="sold">Sold</span>
                            </a>
                        </div>
                        <div class="featured-content">
                            <p><a href="#">Hair care</a></p>
                            <h4><a herf="#">Serum</a></h4>
                            <h5>$80.00</h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="featured-product">
                        <div class="featured-image">
                            <a href="#">
                                <img src="https://samplelinkweb.site/custom-html/r-house/v2/img/featured-image-2.jpg">
                                <span class="new">New</span>
                            </a>
                        </div>
                        <div class="featured-content">
                            <p><a href="#">Hair care</a></p>
                            <h4><a herf="#">Hair Spray</a></h4>
                            <h5>$95.00</h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="featured-product">
                        <div class="featured-image">
                            <a href="#">
                                <img src="https://samplelinkweb.site/custom-html/r-house/v2/img/featured-image-3.jpg">
                            </a>
                        </div>
                        <div class="featured-content">
                            <p><a href="#">Hair tools</a></p>
                            <h4><a herf="#">Round Brush</a></h4>
                            <h5>$40.00</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="product-slide d-none">
        <div class="container">
            <div class="section-title text-center">
                <h2>Our Products</h2>
                <img src="{{ asset('front/images/banner-shape.png') }}" alt="Products"/>
            </div>
            <div class="product-slider">
                <button class="prev-btn">
                    <img src="{{ asset('front/images/arrow-left.png') }}" alt="">
                </button>
                <div class="product-slide__wrapper">
                    <div class="product-slide__item">
                        <div class="product ">
                            <div class="product-type">
                                <h5 class="-new">New</h5>
                            </div>
                            <div class="product-thumb">
                                <a class="product-thumb__image" href="#">
                                    <img src="img/product/1.png" alt="Product image"/>
                                    <img src="img/product/2.png" alt="Product image"/>
                                </a>
                                <div class="product-thumb__actions">
                                    <div class="product-btn"><a class="btn -white product__actions__item -round product-atc" href="#"><i class="fas fa-shopping-bag"></i></a>
                                    </div>
                                    <div class="product-btn"><a class="btn -white product__actions__item -round product-qv" href="#"><i class="fas fa-eye"></i></a>
                                    </div>
                                    <div class="product-btn"><a class="btn -white product__actions__item -round" href="#"><i class="fas fa-heart"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="product-content">
                                <div class="product-content__header">
                                    <div class="product-category">eyes</div>
                                </div>
                                <a class="product-name" href="product-detail.php">The expert mascaraa</a>
                                <div class="product-content__footer">
                                    <h5 class="product-price--main">$35.00</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="product-slide__item">
                        <div class="product ">
                            <div class="product-type"></div>
                            <div class="product-thumb">
                                <a class="product-thumb__image" href="product-detail.php"><img src="img/product/2.png" alt="Product image"/><img src="img/product/3.png" alt="Product image"/></a>
                                <div class="product-thumb__actions">
                                    <div class="product-btn"><a class="btn -white product__actions__item -round product-atc" href="#"><i class="fas fa-shopping-bag"></i></a>
                                    </div>
                                    <div class="product-btn"><a class="btn -white product__actions__item -round product-qv" href="#"><i class="fas fa-eye"></i></a>
                                    </div>
                                    <div class="product-btn"><a class="btn -white product__actions__item -round" href="#"><i class="fas fa-heart"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="product-content">
                                <div class="product-content__header">
                                    <div class="product-category">eyes</div>
                                </div>
                                <a class="product-name" href="product-detail.php">Velvet Melon High Intensity</a>
                                <div class="product-content__footer">
                                    <h5 class="product-price--main">$38.00</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="product-slide__item">
                        <div class="product ">
                            <div class="product-type">
                                <h5 class="-sale">-15%</h5>
                            </div>
                            <div class="product-thumb">
                                <a class="product-thumb__image" href="product-detail.php"><img src="img/product/3.png" alt="Product image"/><img src="img/product/4.png" alt="Product image"/></a>
                                <div class="product-thumb__actions">
                                    <div class="product-btn"><a class="btn -white product__actions__item -round product-atc" href="#"><i class="fas fa-shopping-bag"></i></a>
                                    </div>
                                    <div class="product-btn"><a class="btn -white product__actions__item -round product-qv" href="#"><i class="fas fa-eye"></i></a>
                                    </div>
                                    <div class="product-btn"><a class="btn -white product__actions__item -round" href="#"><i class="fas fa-heart"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="product-content">
                                <div class="product-content__header">
                                    <div class="product-category">eyes</div>
                                </div>
                                <a class="product-name" href="product-detail.php">Leather shopper bag</a>
                                <div class="product-content__footer">
                                    <h5 class="product-price--main">$30.00</h5>
                                    <h5 class="product-price--discount">$35.00</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="product-slide__item">
                        <div class="product ">
                            <div class="product-type"></div>
                            <div class="product-thumb">
                                <a class="product-thumb__image" href="product-detail.php"><img src="img/product/4.png" alt="Product image"/><img src="img/product/5.png" alt="Product image"/></a>
                                <div class="product-thumb__actions">
                                    <div class="product-btn"><a class="btn -white product__actions__item -round product-atc" href="#"><i class="fas fa-shopping-bag"></i></a>
                                    </div>
                                    <div class="product-btn"><a class="btn -white product__actions__item -round product-qv" href="#"><i class="fas fa-eye"></i></a>
                                    </div>
                                    <div class="product-btn"><a class="btn -white product__actions__item -round" href="#"><i class="fas fa-heart"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="product-content">
                                <div class="product-content__header">
                                    <div class="product-category">eyes</div>
                                </div>
                                <a class="product-name" href="product-detail.php">Luxe jewel lipstick</a>
                                <div class="product-content__footer">
                                    <h5 class="product-price--main">$38.00</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="product-slide__item">
                        <div class="product ">
                            <div class="product-type">
                                <h5 class="-sale">-50%</h5>
                            </div>
                            <div class="product-thumb">
                                <a class="product-thumb__image" href="product-detail.php"><img src="img/product/5.png" alt="Product image"/><img src="img/product/6.png" alt="Product image"/></a>
                                <div class="product-thumb__actions">
                                    <div class="product-btn"><a class="btn -white product__actions__item -round product-atc" href="#"><i class="fas fa-shopping-bag"></i></a>
                                    </div>
                                    <div class="product-btn"><a class="btn -white product__actions__item -round product-qv" href="#"><i class="fas fa-eye"></i></a>
                                    </div>
                                    <div class="product-btn"><a class="btn -white product__actions__item -round" href="#"><i class="fas fa-heart"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="product-content">
                                <div class="product-content__header">
                                    <div class="product-category">face</div>
                                </div>
                                <a class="product-name" href="product-detail.php">Penpoint seamless beauty</a>
                                <div class="product-content__footer">
                                    <h5 class="product-price--main">$20.00</h5>
                                    <h5 class="product-price--discount">$40.00</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="product-slide__item">
                        <div class="product ">
                            <div class="product-type"></div>
                            <div class="product-thumb">
                                <a class="product-thumb__image" href="product-detail.php"><img src="img/product/7.png" alt="Product image"/><img src="img/product/8.png" alt="Product image"/></a>
                                <div class="product-thumb__actions">
                                    <div class="product-btn"><a class="btn -white product__actions__item -round product-atc" href="#"><i class="fas fa-shopping-bag"></i></a>
                                    </div>
                                    <div class="product-btn"><a class="btn -white product__actions__item -round product-qv" href="#"><i class="fas fa-eye"></i></a>
                                    </div>
                                    <div class="product-btn"><a class="btn -white product__actions__item -round" href="#"><i class="fas fa-heart"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="product-content">
                                <div class="product-content__header">
                                    <div class="product-category">face</div>
                                </div>
                                <a class="product-name" href="product-detail.php">The Sneaky lips</a>
                                <div class="product-content__footer">
                                    <h5 class="product-price--main">$38.00</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="product-slide__item">
                        <div class="product ">
                            <div class="product-type"></div>
                            <div class="product-thumb">
                                <a class="product-thumb__image" href="product-detail.php"><img src="img/product/8.png" alt="Product image"/><img src="img/product/9.png" alt="Product image"/></a>
                                <div class="product-thumb__actions">
                                    <div class="product-btn"><a class="btn -white product__actions__item -round product-atc" href="#"><i class="fas fa-shopping-bag"></i></a>
                                    </div>
                                    <div class="product-btn"><a class="btn -white product__actions__item -round product-qv" href="#"><i class="fas fa-eye"></i></a>
                                    </div>
                                    <div class="product-btn"><a class="btn -white product__actions__item -round" href="#"><i class="fas fa-heart"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="product-content">
                                <div class="product-content__header">
                                    <div class="product-category">face</div>
                                </div>
                                <a class="product-name" href="product-detail.php">White Facial Cream</a>
                                <div class="product-content__footer">
                                    <h5 class="product-price--main">$38.00</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="product-slide__item">
                        <div class="product ">
                            <div class="product-type"></div>
                            <div class="product-thumb">
                                <a class="product-thumb__image" href="product-detail.php"><img src="img/product/9.png" alt="Product image"/><img src="img/product/10.png" alt="Product image"/></a>
                                <div class="product-thumb__actions">
                                    <div class="product-btn"><a class="btn -white product__actions__item -round product-atc" href="#"><i class="fas fa-shopping-bag"></i></a>
                                    </div>
                                    <div class="product-btn"><a class="btn -white product__actions__item -round product-qv" href="#"><i class="fas fa-eye"></i></a>
                                    </div>
                                    <div class="product-btn"><a class="btn -white product__actions__item -round" href="#"><i class="fas fa-heart"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="product-content">
                                <div class="product-content__header">
                                    <div class="product-category">face</div>
                                </div>
                                <a class="product-name" href="product-detail.php">Orange Massage Cream</a>
                                <div class="product-content__footer">
                                    <h5 class="product-price--main">$55.00</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="next-btn">
                    <img src="{{ asset('front/images/arrow-right.png') }}" alt="">
                </button>
                <div class="text-center">
                    <a class="btn btn-theme" href="">View all product</a>
                </div>
            </div>
        </div>
    </section>
    
    <section class="story">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="history">
                        <h5>{{ $page->findSection('history-heading', '') }}</h5>
                        <h6>{{ $page->findSection('story-heading', '') }}</h6>
                    </div>
                </div>
                <div class="col-md-6">
                    <h4>{{ $page->findSection('story-sub-heading', '') }}</h4>
                    {!! $page->findSection('story-content', '') !!}
                </div>
            </div>
        </div>
    </section>

    <section class="join-us" style="background-image: url('{{ asset($page->image) }}')">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="banner-2-txt text-center color--white">
                        <span class="section-id">{!! $page->findSection('join-us-sub-heading', '') !!}</span>
                        <h2>{!! $page->findSection('join-us-heading', '') !!}</h2>
                        <a class="btn btn-theme" href="{!! $page->findSection('join-us-button-link', '') !!}">{!! $page->findSection('join-us-button-text', '') !!}</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="services">
        <div class="container-fluid">
            <div class="row">
                <!-- Card 1 -->
                <div class="col-md-4 p-0">
                    <div class="card-custom">
                        <a href="{!! $page->findSection('lovely-link', '') !!}">
                            <h2>{!! $page->findSection('lovely-heading', '') !!}</h2>
                            <h3>{!! $page->findSection('lovely-sub-heading', '') !!}</h3>
                            <p>{!! $page->findSection('lovely-content', '') !!}</p>
                        </a>
                    </div>
                </div>
                <!-- Card 2 (black background) -->
                <div class="col-md-4 p-0">
                    <div class="card-custom middle-card-custom">
                        <a href="{!! $page->findSection('change-link', '') !!}">
                            <h2>{!! $page->findSection('change-heading', '') !!}</h2>
                            <h3>{!! $page->findSection('change-sub-heading', '') !!}</h3>
                            <p>{!! $page->findSection('change-content', '') !!}</p>
                        </a>
                    </div>
                </div>
                <!-- Card 3 -->
                <div class="col-md-4 p-0">
                    <div class="card-custom">
                        <a href="{!! $page->findSection('perfect-link', '') !!}">
                            <h2>{!! $page->findSection('perfect-heading', '') !!}</h2>
                            <h3>{!! $page->findSection('perfect-sub-heading', '') !!}</h3>
                            <p>{!! $page->findSection('perfect-content', '') !!}</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
@endsection
