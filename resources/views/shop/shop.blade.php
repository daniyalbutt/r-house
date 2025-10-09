@extends('layouts.app')
@section('content')
    <section class="inner-banner shop-banner">
        <div class="breadcrumb" style="background-image: url({{ asset($page->image) }});">
            <h6>{{ $page->findSection('banner-title', '') }}</h6>
            <h2>{{ $page->name }}</h2>
        </div>
    </section>

    <section class="shop">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-4 col-lg-3">
                    <div class="shop-sidebar">
                        <div class="shop-sidebar__content">
                            <div class="shop-sidebar__section -categories">
                                <div class="section-title -style1 -medium" style="margin-bottom:1.875em">
                                    <h2>Categories</h2>
                                    <img src="{{ asset('front/images/banner-shape.png') }}" alt="Decoration"/>
                                </div>
                                <ul class="category-list">
                                    <li><a href="{{ route('shop', array_merge(request()->except('page'), ['category' => null])) }}" class="{{ request('category') ? '' : 'active' }}">All</a></li>
                                    @foreach($categories as $cat)
                                        <li>
                                            <a href="{{ route('shop', array_merge(request()->except('page'), ['category' => $cat->id])) }}"
                                            class="{{ request('category') == $cat->id ? 'active' : '' }}">
                                            {{ $cat->name }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="shop-sidebar__section -refine">
                                <div class="section-title -style1 -medium" style="margin-bottom:1.875em">
                                    <h2>Refine Search</h2>
                                    <img src="{{ asset('front/images/banner-shape.png') }}" alt="Decoration"/>
                                </div>
                                <div class="shop-sidebar__section__item">
                                    <h5>Extension Types</h5>
                                    <form id="filterForm" method="GET" action="{{ route('shop') }}">
                                        @foreach(request()->except('extension_type', 'page') as $key => $value)
                                            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                                        @endforeach
                                        <ul>
                                            @foreach($extensionTypes as $index => $type)
                                                @php
                                                    $formatted = ucfirst(str_replace('-', ' ', $type));
                                                    $checked = collect((array)request('extension_type'))->contains($type);
                                                @endphp
                                                <li>
                                                    <label for="ext-{{ $index }}">
                                                        <input 
                                                            type="checkbox" 
                                                            id="ext-{{ $index }}" 
                                                            name="extension_type[]" 
                                                            value="{{ $type }}" 
                                                            {{ $checked ? 'checked' : '' }}
                                                            onchange="document.getElementById('filterForm').submit();"
                                                        >
                                                        {{ $formatted }}
                                                    </label>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </form>
                                </div>
                                <div class="shop-sidebar__section__item">
                                    <h5>Colors</h5>
                                    <form method="GET" action="{{ route('shop') }}">
                                        @foreach(request()->except(['page', 'color']) as $key => $value)
                                            @if(is_array($value))
                                                @foreach($value as $v)
                                                    <input type="hidden" name="{{ $key }}[]" value="{{ $v }}">
                                                @endforeach
                                            @else
                                                <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                                            @endif
                                        @endforeach
                                        <ul>
                                            @foreach($colors as $color)
                                                <li>
                                                    <label>
                                                        <input type="checkbox" name="color[]" value="{{ $color }}"
                                                            onchange="this.form.submit()"
                                                            {{ is_array(request('color')) && in_array($color, request('color')) ? 'checked' : '' }}>
                                                        {{ ucfirst($color) }}
                                                    </label>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </form>
                                </div>

                                <div class="shop-sidebar__section__item">
                                    <h5>Length</h5>
                                    <form method="GET" action="{{ route('shop') }}">
                                        @foreach(request()->except(['page', 'length']) as $key => $value)
                                            @if(is_array($value))
                                                @foreach($value as $v)
                                                    <input type="hidden" name="{{ $key }}[]" value="{{ $v }}">
                                                @endforeach
                                            @else
                                                <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                                            @endif
                                        @endforeach
                                        <ul>
                                            @foreach($lengths as $length)
                                                <li>
                                                    <label>
                                                        <input type="checkbox" name="length[]" value="{{ $length }}"
                                                            onchange="this.form.submit()"
                                                            {{ is_array(request('length')) && in_array($length, request('length')) ? 'checked' : '' }}>
                                                        {{ ucfirst($length) }}
                                                    </label>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </form>
                                </div>

                                <div class="shop-sidebar__section__item">
                                    <h5>Weights</h5>
                                    <form method="GET" action="{{ route('shop') }}">
                                        @foreach(request()->except(['page', 'weights']) as $key => $value)
                                            @if(is_array($value))
                                                @foreach($value as $v)
                                                    <input type="hidden" name="{{ $key }}[]" value="{{ $v }}">
                                                @endforeach
                                            @else
                                                <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                                            @endif
                                        @endforeach
                                        <ul>
                                            @foreach($weights as $weight)
                                                <li>
                                                    <label>
                                                        <input type="checkbox" name="weight[]" value="{{ $weight }}"
                                                            onchange="this.form.submit()"
                                                            {{ is_array(request('weight')) && in_array($weight, request('weight')) ? 'checked' : '' }}>
                                                        {{ ucfirst($weight) }}
                                                    </label>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </form>
                                </div>

                                <div class="shop-sidebar__section__item">
                                    <h5>Price</h5>
                                    <form id="priceFilterForm" method="GET" action="{{ route('shop') }}">
                                        @foreach(request()->except(['page', 'min_price', 'max_price']) as $key => $value)
                                            @if(is_array($value))
                                                @foreach($value as $v)
                                                    <input type="hidden" name="{{ $key }}[]" value="{{ $v }}">
                                                @endforeach
                                            @else
                                                <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                                            @endif
                                        @endforeach
                                        <div class="price-range-inputs">
                                            <input type="number" name="min_price" value="{{ request('min_price', '') }}" placeholder="Min" class="form-control mb-2" step="0.01" min="0">
                                            <input type="number" name="max_price" value="{{ request('max_price', '') }}" placeholder="Max" class="form-control mb-2" step="0.01" min="0">
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-sm w-100 btn btn-theme">Apply</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-8 col-lg-9">
                    <div class="shop-header">
                        <form id="sortForm" method="GET" action="{{ route('shop') }}">
                            <select class="customed-select" name="sort" id="sortSelect" onchange="document.getElementById('sortForm').submit();">
                                <option value="">Default</option>
                                <option value="az" {{ request('sort') == 'az' ? 'selected' : '' }}>A to Z</option>
                                <option value="za" {{ request('sort') == 'za' ? 'selected' : '' }}>Z to A</option>
                                <option value="low-high" {{ request('sort') == 'low-high' ? 'selected' : '' }}>Low to High Price</option>
                                <option value="high-low" {{ request('sort') == 'high-low' ? 'selected' : '' }}>High to Low Price</option>
                            </select>
                        </form>
                    </div>
                    <div class="shop-products">
                        <div class="shop-products__gird">
                            <div class="row">
                                @foreach ($products as $item)
                                <div class="col-12 col-sm-6 col-lg-4">
                                    <div class="product ">
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
                    </div>
                    {{ $products->links('pagination::bootstrap-4') }}
                    <ul class="paginator d-none">
                        <li class="page-item active">
                            <button class="page-link">1</button>
                        </li>
                        <li class="page-item">
                            <button class="page-link">2</button>
                        </li>
                        <li class="page-item">
                            <button class="page-link"><i class="fa fa-angle-right" aria-hidden="true"></i></button>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('css')
    
@endpush

@push('js')

@endpush
