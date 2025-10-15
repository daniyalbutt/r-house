@extends('layouts.app')
@section('content')
<section class="inner-banner about-banner">
    <div class="breadcrumb">
        <h6>Save now, shop later</h6>
        <h2>My Wishlist</h2>
    </div>
</section>

<section class="dashboardSection">
    <div class="my-account-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="myaccount-page-wrapper">
                        <div class="row">
                            <div class="col-lg-3 col-md-4">
                                <div class="myaccount-tab-menu nav" role="tablist">
                                    @include('user.include.sidebar')
                                </div>
                            </div>
                            <div class="col-lg-9 col-md-8">
                                <div class="tab-content" id="myaccountContent">
                                    <!-- Single Tab Content Start -->
                                    <div class="tab-pane fade show active" id="dashboad">
                                        <div class="myaccount-content">
                                            <div class="row">
                                                @if ($wishlist->isEmpty())
                                                    <div class="col-12 text-center">
                                                        <div class="empty-wishlist">
                                                            <i class="fa-solid fa-heart"></i>
                                                            <h5>Your wishlist is empty</h5>
                                                            <p>Start adding items you love and save them for later.</p>
                                                            <a href="{{ route('shop') }}" class="btn btn-theme mt-3">Continue Shopping</a>
                                                        </div>
                                                    </div>
                                                @else
                                                    @foreach ($wishlist as $items)
                                                        <div class="col-lg-6">
                                                            <div class="innerproducts">
                                                                <a href="{{ route('product.detail', $items->slug) }}">
                                                                    <figure>
                                                                        <img src="{{ asset($items->image) }}"
                                                                            class="img-fluid" alt="">

                                                                    </figure>
                                                                    <div class="product-txt">
                                                                        <span>{{ $items->category->name }}</span>
                                                                        <h5>{{ $items->name }}</h5>
                                                                        <strong>$ {{ $items->price }}</strong>
                                                                    </div>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endif
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
    </div>
</section>
@endsection
@push('css')
@endpush

@push('js')
@endpush
