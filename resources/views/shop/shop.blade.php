@extends('layouts.app')
@section('content')
    <section class="banner">
        <div class="container">
            <div class="row">
                <div class="inner-banner">
                    <h1 class="banner-title-head">Shop</h1>
                </div>
            </div>
    </section>

    <main class="cd-main-content">
        <div class="cd-tab-filter-wrapper">
            <div class="cd-tab-filter">
                <ul class="cd-filters">
                    <li class="placeholder">
                        <a data-type="all" href="#0">All</a> <!-- selected option on mobile -->
                    </li>
                    <li class="filter"><a class="selected" href="#0" data-type="all">All</a></li>

                    @foreach ($category as $item)
                        <li class="filter" data-filter=".{{ $item->slug }}"><a href="#0"
                                data-type="{{ $item->slug }}">{{ $item->name }}</a></li>
                    @endforeach

                </ul> <!-- cd-filters -->
            </div> <!-- cd-tab-filter -->
        </div> <!-- cd-tab-filter-wrapper -->

        <section class="cd-gallery">

            <ul>
                @foreach ($products as $item)
                    <li class="mix {{ $item->category->slug }} check1 radio2 option3" data-title='{{ $item->name }}'>
                        <div class="overlay">
                            <div class="buttons">
                                <button class="cart-button"><i class="fas fa-shopping-cart"></i></button>
                                <button class="quick-button" data-detail='{{ $item->toJson() }}'><i
                                        class="fa-regular fa-eye"></i></button>
                            </div>
                            <div class="product-content">
                                <a href="" class="product-title">{{ $item->name }}</a>
                                <span class="price">${{ $item->price }}</span>
                            </div>
                        </div>
                        <img src="{{ asset($item->image) }}" alt="Image 1">



                    </li>
                @endforeach



                <li class="gap"></li>
                <li class="gap"></li>
                <li class="gap"></li>
            </ul>
            <div class="cd-fail-message">No results found</div>
        </section> <!-- cd-gallery -->

        <div class="cd-filter">
            <form>
                <div class="cd-filter-block">
                    <h4>Search</h4>

                    <div class="cd-filter-content">
                        <input type="search" placeholder="Try cat-1...">
                    </div> <!-- cd-filter-content -->
                </div> <!-- cd-filter-block -->

                <div class="cd-filter-block">
                    <h4>Check boxes</h4>

                    <ul class="cd-filter-content cd-filters list">
                        <li>
                            <input class="filter" data-filter=".check1" type="checkbox" id="checkbox1">
                            <label class="checkbox-label" for="checkbox1">Option 1</label>
                        </li>

                        <li>
                            <input class="filter" data-filter=".check2" type="checkbox" id="checkbox2">
                            <label class="checkbox-label" for="checkbox2">Option 2</label>
                        </li>

                        <li>
                            <input class="filter" data-filter=".check3" type="checkbox" id="checkbox3">
                            <label class="checkbox-label" for="checkbox3">Option 3</label>
                        </li>
                    </ul> <!-- cd-filter-content -->
                </div> <!-- cd-filter-block -->

                <div class="cd-filter-block">
                    <h4>Select</h4>

                    <div class="cd-filter-content">
                        <div class="cd-select cd-filters">
                            <select class="filter" name="selectThis" id="selectThis">
                                <option value="">Choose an option</option>
                                <option value=".option1">Option 1</option>
                                <option value=".option2">Option 2</option>
                                <option value=".option3">Option 3</option>
                                <option value=".option4">Option 4</option>
                            </select>
                        </div> <!-- cd-select -->
                    </div> <!-- cd-filter-content -->
                </div> <!-- cd-filter-block -->

                <div class="cd-filter-block">
                    <h4>Radio buttons</h4>

                    <ul class="cd-filter-content cd-filters list">
                        <li>
                            <input class="filter" data-filter="" type="radio" name="radioButton" id="radio1" checked>
                            <label class="radio-label" for="radio1">All</label>
                        </li>

                        <li>
                            <input class="filter" data-filter=".radio2" type="radio" name="radioButton" id="radio2">
                            <label class="radio-label" for="radio2">Choice 2</label>
                        </li>

                        <li>
                            <input class="filter" data-filter=".radio3" type="radio" name="radioButton" id="radio3">
                            <label class="radio-label" for="radio3">Choice 3</label>
                        </li>
                    </ul> <!-- cd-filter-content -->
                </div> <!-- cd-filter-block -->
            </form>

            <a href="#0" class="cd-close">Close</a>
        </div> <!-- cd-filter -->

        <a href="#0" class="cd-filter-trigger">Filters</a>
    </main> <!-- cd-main-content -->
    <!-- Modal -->
    <div class="modal fade" id="productmodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="product-title">Modal title</h5>
                </div>

                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="swiper swiper_main">
                                    <div class="swiper-wrapper">
                                        <div class="swiper-slide"><img
                                                src="https://images.unsplash.com/photo-1505740420928-5e560c06d30e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8M3x8cHJvZHVjdHxlbnwwfHwwfHx8MA%3D%3D&w=1000&q=80">
                                        </div>
                                        <div class="swiper-slide"><img
                                                src="https://images.unsplash.com/photo-1505740420928-5e560c06d30e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8M3x8cHJvZHVjdHxlbnwwfHwwfHx8MA%3D%3D&w=1000&q=80">
                                        </div>
                                        <div class="swiper-slide"><img
                                                src="https://images.unsplash.com/photo-1505740420928-5e560c06d30e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8M3x8cHJvZHVjdHxlbnwwfHwwfHx8MA%3D%3D&w=1000&q=80">
                                        </div>
                                        <div class="swiper-slide"><img
                                                src="https://images.unsplash.com/photo-1505740420928-5e560c06d30e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8M3x8cHJvZHVjdHxlbnwwfHwwfHx8MA%3D%3D&w=1000&q=80">
                                        </div>
                                    </div>
                                    <div class="swiper-button-prev"></div>
                                    <div class="swiper-button-next"></div>
                                </div>
                                <div class="swiper swiper_thumbnail">
                                    <div class="swiper-wrapper">
                                        <div class="swiper-slide"><img
                                                src="https://images.unsplash.com/photo-1505740420928-5e560c06d30e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8M3x8cHJvZHVjdHxlbnwwfHwwfHx8MA%3D%3D&w=1000&q=80">
                                        </div>
                                        <div class="swiper-slide"><img
                                                src="https://images.unsplash.com/photo-1505740420928-5e560c06d30e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8M3x8cHJvZHVjdHxlbnwwfHwwfHx8MA%3D%3D&w=1000&q=80">
                                        </div>
                                        <div class="swiper-slide"><img
                                                src="https://images.unsplash.com/photo-1505740420928-5e560c06d30e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8M3x8cHJvZHVjdHxlbnwwfHwwfHx8MA%3D%3D&w=1000&q=80">
                                        </div>
                                        <div class="swiper-slide"><img
                                                src="https://images.unsplash.com/photo-1505740420928-5e560c06d30e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8M3x8cHJvZHVjdHxlbnwwfHwwfHx8MA%3D%3D&w=1000&q=80">
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="product-details">
                                    <p id="product-desc"></p>
                                    <div class="quantity-counter">
                                        <button class="quantity-button minus">-</button>
                                        <input type="number" class="quantity-input" id="qty" value="1" min="1">
                                        <button class="quantity-button plus">+</button>
                                    </div>
                                    <a class="btn add-cart" href=""><i class="fa-solid fa-circle-info"></i> View Details</a>
                                    <button class="btn add-cart" id="addcart" onclick="addToCart(this)"><i class="fas fa-shopping-cart"></i> Add to Cart</button>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
@endsection

@push('css')
    <link rel="stylesheet" href="{{ asset('front/css/shop.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
@endpush

@push('js')
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

    <script src="{{ asset('front/js/modernizr.js') }}"></script>
    <script src="{{ asset('front/js/jquery.mixitup.min.js') }}"></script>
    <script src="{{ asset('front/js/main.js') }}"></script>
    <script src="{{ asset('front/js/shop.js') }}"></script>

@endpush
