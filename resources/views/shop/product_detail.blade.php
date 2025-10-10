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
                                <h3 data-base-price="{{ $product->price }}">${{ number_format($product->price, 2) }}</h3>
                                <div class="divider"></div>
                                <div class="product-detail__content__footer">
                                    <ul>
                                        <li>
                                            Availability:
                                            @if($product->stock > 0)
                                                <span class="text-success">In Stock ({{ $product->stock }})</span>
                                            @else
                                                <span class="text-danger">Out of Stock</span>
                                            @endif
                                        </li>

                                    </ul>
                                    <div class="product-detail__controller product-detail-variation">
                                        <form id="addToCartForm" method="POST" action="{{ route('cart.add', $product->id) }}">
                                            @csrf
                                            <input type="hidden" id="product-stock" value="{{ $product->stock }}">
                                            @foreach($attributes as $slug => $values)
                                            @php
                                                $label = ucfirst(str_replace('_', ' ', $slug));
                                            @endphp
                                            <div class="form-group mb-3">
                                                <label class="d-block mb-2">
                                                    {{ $label }} * <small class="text-danger error-{{ $slug }}"></small>
                                                </label>
                                                <div class="btn-group" role="group" aria-label="{{ $label }} Options">
                                                    @foreach ($values as $value)
                                                        <button type="button"
                                                                class="btn btn-outline-dark {{ $slug }}-option"
                                                                data-name="{{ $slug }}"
                                                                data-value="{{ $value->attribute_value }}"
                                                                data-addon="{{ $value->addon }}">
                                                            {{ ucfirst($value->attribute_value) }}
                                                            @if($value->addon > 0)
                                                                <small class="text-success">(+${{ $value->addon }})</small>
                                                            @endif
                                                        </button>
                                                    @endforeach
                                                </div>
                                                <input type="hidden" name="attribute[{{ $slug }}]" id="selected_{{ $slug }}">
                                            </div>
                                            @endforeach
                                            <div class="divider"></div>
                                            <div class="product-detail__controller product-detail__controller_inner">
                                                <div class="quantity-controller -border -round d-flex align-items-center">
                                                    <button type="button" class="quantity-controller__btn -descrease">-</button>
                                                    <input type="number" name="quantity" class="quantity-controller__number mx-2" value="1" min="1" readonly>
                                                    <button type="button" class="quantity-controller__btn -increase">+</button>
                                                </div>
                                                <div class="add-to-cart -dark">
                                                    @if($product->stock > 0)
                                                    <button type="submit" class="btn -round -red">
                                                        <i class="fas fa-shopping-bag"></i> Add to Cart
                                                    </button>
                                                    @else
                                                    <button type="button" class="btn -round -gray" disabled>
                                                        <i class="fas fa-ban"></i> Out of stock
                                                    </button>
                                                    @endif
                                                </div>
                                            </div>
                                        </form>
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
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const priceEl = document.querySelector('.product-detail__content h3');
        const basePrice = parseFloat(priceEl?.dataset.basePrice || 0);
        let totalAddon = 0;

        const updatePrice = () => {
            totalAddon = 0;
            document.querySelectorAll('[class*="-option"].active').forEach(active => {
                totalAddon += parseFloat(active.dataset.addon || 0);
            });
            const newPrice = basePrice + totalAddon;
            priceEl.textContent = `$${newPrice.toFixed(2)}`;
        };

        document.querySelectorAll('[class*="-option"]').forEach(button => {
            button.addEventListener('click', function() {
                const name = this.dataset.name;
                const value = this.dataset.value;
                const input = document.querySelector(`#selected_${name}`);
                const errorEl = document.querySelector(`.error-${name}`);
                document.querySelectorAll(`.${name}-option`).forEach(btn => btn.classList.remove('active'));
                this.classList.add('active');
                if (input) input.value = value;
                if (errorEl) errorEl.textContent = '';
                updatePrice();
            });
        });

        document.querySelectorAll('.quantity-controller').forEach(controller => {
            const decrease = controller.querySelector('.-descrease');
            const increase = controller.querySelector('.-increase');
            const input = controller.querySelector('.quantity-controller__number');
            const maxStock = parseInt(document.getElementById('product-stock')?.value || 0);
            decrease.addEventListener('click', () => {
                let value = parseInt(input.value) || 1;
                if (value > 1) input.value = value - 1;
            });
            increase.addEventListener('click', () => {
                let value = parseInt(input.value) || 1;
                if (maxStock && value < maxStock) {
                    input.value = value + 1;
                } else if (maxStock && value >= maxStock) {
                    alert(`Only ${maxStock} items available in stock.`);
                } else {
                    input.value = value + 1;
                }
            });
        });

        const addToCartForm = document.getElementById('addToCartForm');
        if (addToCartForm) {
            addToCartForm.addEventListener('submit', function(e) {
                let hasError = false;
                document.querySelectorAll('input[type="hidden"][id^="selected_"]').forEach(input => {
                    const name = input.id.replace('selected_', '');
                    const errorEl = document.querySelector(`.error-${name}`);
                    if (errorEl) errorEl.textContent = ''; // clear old errors
                    if (!input.value) {
                        if (errorEl) errorEl.textContent = `Please select a ${name}.`;
                        hasError = true;
                    }
                });
                if (hasError) e.preventDefault();
            });
        }
    });
</script>
@endpush
