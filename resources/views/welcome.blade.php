@extends('layouts.app')
@section('content')
    <section class="BannerSection">
        <div class="container custom-container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="productslider">
                        <div>
                            <div class="oreoproduct">
                                <div class="oreotext">
                                    <span>Quick View</span>
                                    <h1>OREO Original <br>
                                        56 Snack Packs</h1>
                                    <small>(2 Cookies Per Pack)</small>
                                    <ul class="list-unstyled">
                                        <li class="first"><img src="{{ asset('front/images/c1.png') }}" class="img-fluid"
                                                alt="">
                                            <span>$3.50</span>
                                        </li>
                                        <li class="second"><img src="{{ asset('front/images/c2.png') }}" class="img-fluid"
                                                alt="">
                                            <span>$3.50</span>
                                        </li>
                                        <li class="third"><img src="{{ asset('front/images/c3.png') }}" class="img-fluid"
                                                alt="">
                                            <span>$3.50</span>
                                        </li>
                                        <li class="last"><img src="{{ asset('front/images/c4.png') }}" class="img-fluid"
                                                alt="">
                                            <span>$3.50</span>
                                        </li>
                                    </ul>
                                    <a href="#" class="morebtn">More</a>
                                </div>
                                <img src="{{ asset('front/images/oreo-sd.png') }}" class="img-fluid" alt="">
                            </div>
                        </div>
                        <div>
                            <div class="oreoproduct">
                                <div class="oreotext">
                                    <span>Quick View</span>
                                    <h1>OREO Original <br>
                                        56 Snack Packs</h1>
                                    <small>(2 Cookies Per Pack)</small>
                                    <ul class="list-unstyled">
                                        <li class="first"><img src="{{ asset('front/images/c1.png') }}" class="img-fluid"
                                                alt="">
                                            <span>$3.50</span>
                                        </li>
                                        <li class="second"><img src="{{ asset('front/images/c2.png') }}" class="img-fluid"
                                                alt="">
                                            <span>$3.50</span>
                                        </li>
                                        <li class="third"><img src="{{ asset('front/images/c3.png') }}" class="img-fluid"
                                                alt="">
                                            <span>$3.50</span>
                                        </li>
                                        <li class="last"><img src="{{ asset('front/images/c4.png') }}" class="img-fluid"
                                                alt="">
                                            <span>$3.50</span>
                                        </li>
                                    </ul>
                                    <a href="#" class="morebtn">More</a>
                                </div>
                                <img src="{{ asset('front/images/oreo-sd.png') }}" class="img-fluid" alt="">
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-lg-3">
                    <div class="newyorkslider">
                        <div>
                            <div class="newyorkInner"
                                style="background: url('{{ asset('front/images/newyork-bg.jpg') }}') no-repeat;background-size: cover;height: 100%;">
                                <span>Showcase</span>
                                <h2>New York Strawberry <br>
                                    Cheesecake Ice Cream</h2>
                                <small>Lowest Price on Target</small>
                                <strong> <img src="{{ asset('front/images/newyork-p.png') }}" class="img-fluid"
                                        alt=""> $299</strong>
                                <img src="{{ asset('front/images/newyork-inn.png') }}" class="img-fluid" alt="">
                            </div>
                        </div>
                        <div>
                            <div class="newyorkInner"
                                style="background: url('{{ asset('front/images/newyork-bg.jpg') }}') no-repeat;background-size: cover;height: 100%;">
                                <span>Showcase</span>
                                <h2>New York Strawberry <br>
                                    Cheesecake Ice Cream</h2>
                                <small>Lowest Price on Target</small>
                                <strong> <img src="{{ asset('front/images/newyork-p.png') }}" class="img-fluid"
                                        alt=""> $299</strong>
                                <img src="{{ asset('front/images/newyork-inn.png') }}" class="img-fluid" alt="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="advertisment-space">
                        <img src="{{ asset('front/images/ad-sd1.png') }}" class="img-fluid" alt="">
                        <h4>Advertisement Space Block 2!!!</h4>
                        <p>If interested in advertising in this place please contact <a href="https://coolbeanzmedia.com/"
                                target="_blank">Cool Beanz Media LLC</a> for pricing.
                            At <a href="mailto:coolbeanzmedia@outlook.com" target="_blank">coolbeanzmedia@outlook.com</a>
                        </p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-5">
                    <div class="explore-slider">
                        <div>
                            <div class="exploreInner">
                                <div>
                                    <h3>Explore the <br>Stores</h3>

                                    <a href="javascript:;" class="visitbtn"> Visit Website</a>
                                </div>
                                <img src="{{ asset('front/images/explore-log1.png') }}" class="img-fluid" alt="">
                            </div>
                        </div>
                        <div>
                            <div class="exploreInner">
                                <div>
                                    <h3>Explore the <br>Stores</h3>

                                    <a href="javascript:;" class="visitbtn"> Visit Website</a>
                                </div>
                                <img src="{{ asset('front/images/explore-log1.png') }}" class="img-fluid" alt="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="fruit-inner"
                                style="background: url('{{ asset('front/images/fruit-bg.png') }}') no-repeat;">
                                <h4>Fruit Combination <br>
                                    of daily juice</h4>
                                <a href="javascript:;" class="readbtn">Read More <i class="far fa-arrow-right"></i></a>
                                <span><img src="img/user1.png" class="img-fluid" alt=""> John Doe</span>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="reviewSlider">
                                <div>
                                    <div class="reviewBanner">
                                        <div>
                                            <div class="reviewinner">
                                                <img src="img/quote.png" class="img-fluid quotesMain" alt="">
                                                <p>Sed porttitor arcu libero. Vivamus faucibus vehicula nisi viverra
                                                    consectetur. Maecenas convallis eros ipsum, at cursus dui malesuada
                                                    et.</p>
                                                <img src="img/user12.png" class="img-fluid" alt="">
                                                <span>James Anderson</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div class="reviewBanner">
                                        <div>
                                            <div class="reviewinner">
                                                <img src="img/quote.png" class="img-fluid quotesMain" alt="">
                                                <p>Sed porttitor arcu libero. Vivamus faucibus vehicula nisi viverra
                                                    consectetur. Maecenas convallis eros ipsum, at cursus dui malesuada
                                                    et.</p>
                                                <img src="img/user12.png" class="img-fluid" alt="">
                                                <span>James Anderson</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="advert-blockThree">
                                <img src="{{ asset('front/images/ad-sd1.png') }}" class="img-fluid" alt="">
                                <h4>Advertisement Space Block 2!!!</h4>
                                <p>If interested in advertising in this place please contact <a
                                        href="https://coolbeanzmedia.com/" target="_blank">Cool Beanz Media LLC</a> for
                                    pricing.
                                    At <a href="mailto:coolbeanzmedia@outlook.com"
                                        target="_blank">coolbeanzmedia@outlook.com</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="CategorieSection">
        <div class="container custom-container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="parent-head">
                        <h2><img src="{{ asset('front/images/cat1.png') }}" class="img-fluid" alt=""> Categories
                        </h2>
                        <a href="javascript:;" class="viewbtns">View All</a>
                    </div>

                    <div class="categorylists">
                        <ul class="list-unstyled">
                            @foreach ($categories as $items)
                                <li><a href="javascript:;"><img src="{{ asset($items->image) }}" class="img-fluid"
                                            alt="">
                                        <span>{{ $items->name }}</span></a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="TrendingProduct">
        <div class="container custom-container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="parent-head">
                        <h2>Trending Products</h2>
                        <a href="deals-category.php" class="viewbtns">See all Trending products</a>
                    </div>
                </div>
                @foreach ($trendingProducts as $items)
                    <div class="col-lg-2">
                        <div class="innproducts">
                            <figure>
                                <span>NEW</span>
                                <img src="{{ asset($items->image) }}" class="img-fluid" alt="">
                                <a href="javascript:;" class="prodBtn"> <i class="fas fa-plus"></i></a>
                            </figure>
                            <h5>Product Title Here</h5>
                            {!! $items->short_desc !!}
                            <small>Start From <strong>${{ $items->price }}</strong></small>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <section class="TrendingProduct">
        <div class="container custom-container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="parent-head">
                        <h2><img src="{{ asset('front/images/deal1.png') }}" alt=""> Best Deals, Cool Finds</h2>
                        <a href="deals-category.php" class="viewbtns">See all deals</a>
                    </div>
                </div>
                @foreach ($dealProducts as $items)
                    <div class="col-lg-2">
                        <div class="innproducts">
                            <figure>
                                <span>NEW</span>
                                <img src="{{ asset($items->image) }}" class="img-fluid" alt="">
                                <a href="javascript:;" class="prodBtn"> <i class="fas fa-plus"></i></a>
                            </figure>
                            <h5>{{ $items->name }}</h5>
                            {!! $items->short_desc !!}
                            <small>Start From <strong>$23.90</strong></small>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <section class="TrendingProduct">
        <div class="container custom-container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="parent-head">
                        <h2> Frozen Foods</h2>
                        <a href="deals-category.php" class="viewbtns">See all</a>
                    </div>
                </div>
                @foreach ($trendingProducts as $items)
                    <div class="col-lg-2">
                        <div class="innproducts">
                            <figure>
                                <span>NEW</span>
                                <img src="{{ asset($items->image) }}" class="img-fluid" alt="">
                                <a href="javascript:;" class="prodBtn"> <i class="fas fa-plus"></i></a>
                            </figure>
                            <h5>{{ $items->name }}</h5>
                            {!! $items->short_desc !!}
                            <small>Start From <strong>${{ $items->price }}</strong></small>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="AdvertismentSection">
        <div class="container custom-container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="innadds">
                        <img src="{{ asset($page->findSection('advertisement-space-block-image')) }}" class="img-fluid"
                            alt="">
                        {!! $page->findSection('advertisement-space') !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="TrendingProduct">
        <div class="container custom-container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="parent-head">
                        <h2> Fresh Organic Food</h2>
                        <a href="deals-category.php" class="viewbtns">See all</a>
                    </div>
                </div>
                @foreach ($trendingProducts as $items)
                    <div class="col-lg-2">
                        <div class="innproducts">
                            <figure>
                                <span>NEW</span>
                                <img src="{{ asset($items->image) }}" class="img-fluid" alt="">
                                <a href="javascript:;" class="prodBtn"> <i class="fas fa-plus"></i></a>
                            </figure>
                            <h5>{{ $items->name }}</h5>
                            {!! $items->short_desc !!}
                            <small>Start From <strong>${{ $items->price }}</strong></small>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <section class="TrendingProduct">
        <div class="container custom-container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="parent-head">
                        <h2> Similar Products</h2>
                        <a href="deals-category.php" class="viewbtns">See all</a>
                    </div>
                </div>
                @foreach ($trendingProducts as $items)
                    <div class="col-lg-2">
                        <div class="innproducts">
                            <figure>
                                <span>NEW</span>
                                <img src="{{ asset($items->image) }}" class="img-fluid" alt="">
                                <a href="javascript:;" class="prodBtn"> <i class="fas fa-plus"></i></a>
                            </figure>
                            <h5>{{ $items->name }}</h5>
                            {!! $items->short_desc !!}
                            <small>Start From <strong>${{ $items->price }}</strong></small>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <section class="AboutBuddy">
        <div class="container custom-container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="about-txt">
                        {!! $page->findSection('about-basket') !!}
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="aboutapps">
                        <ol class="list-unstyled">
                            <li><a href="javascript:;"><img src="img/appstore.png" class="img-fluid" alt=""></a>
                            </li>
                            <li><a href="javascript:;"><img src="img/playstore.png" class="img-fluid"
                                        alt=""></a></li>
                        </ol>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="inneraboutbuddy">
                        <img src="{{ asset('front/images/a1.svg') }}" class="img-fluid" alt="">
                        {!! $page->findSection('find-products') !!}
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="inneraboutbuddy">
                        <img src="{{ asset('front/images/a2.svg') }}" class="img-fluid" alt="">
                        {!! $page->findSection('independent-and-trustworthy') !!}
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="inneraboutbuddy">
                        <img src="{{ asset('front/images/a3.svg') }}" class="img-fluid" alt="">
                        {!! $page->findSection('free-to-use') !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
