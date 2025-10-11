@extends('layouts.app')
@section('content')
    <section class="inner-banner">
        <div class="breadcrumb">
            <div class="container">
                <h2>Cart</h2>
                <ul>
                    <li>Home</li>
                    <li class="active">Cart</li>
                </ul>
            </div>
        </div>
    </section>
    <div class="shop">
        <div class="container">
            <div class="cart">
                @if(session('success'))
                <div class="alert alert-success mb-4">{{ session('success') }}</div>
                @endif
                @if(empty($cart))
                <div class="alert alert-info text-center">
                    Your cart is currently empty. <a href="{{ route('shop') }}">Continue Shopping</a>
                </div>
                @else
                <div class="cart__table">
                    <div class="cart__table__wrapper">
                        <table>
                            <colgroup>
                                <col/>
                                <col/>
                                <col/>
                                <col/>
                                <col style="width: 1%"/>
                            </colgroup>
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($cart as $index => $item)
                                <tr>
                                    <td>
                                        <div class="cart-product">
                                            <div class="cart-product__image">
                                                <img src="{{ asset($item['image']) }}" alt="{{ $item['name'] }}"/>
                                            </div>
                                            <div class="cart-product__content">
                                                <h5>{{ $item['category'] }}</h5>
                                                <a href="{{ route('product.details', $item['slug']) }}">{{ $item['name'] }}</a>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        @if(!empty($item['attributes']))
                                        <ul class="list-unstyled mb-0">
                                            @foreach($item['attributes'] as $attr)
                                                <li>
                                                    <strong>{{ ucfirst($attr['name']) }}:</strong>
                                                    {{ $attr['value'] }}
                                                    @if($attr['addon'] > 0)
                                                        <small class="text-success">(+${{ number_format($attr['addon'], 2) }})</small>
                                                    @endif
                                                </li>
                                            @endforeach
                                        </ul>
                                        @endif
                                    </td>
                                    <td>
                                        
                                        <div class="quantity-controller" data-url="{{ route('cart.update', $index) }}">
                                            <div class="quantity-controller__btn -descrease">-</div>
                                            <div class="quantity-controller__number">{{ $item['quantity'] }}</div>
                                            <div class="quantity-controller__btn -increase">+</div>
                                        </div>
                                    </td>
                                    <td class="cart_total_price">
                                        <div class="upper">
                                            <span>(${{ number_format($item['base_price'], 2) }}</span>
                                            @foreach($item['attributes'] as $attr)
                                                @if(isset($attr['addon']) && $attr['addon'] > 0)
                                                    <span>+ ${{ number_format($attr['addon'], 2) }}
                                                @endif)</span>
                                            @endforeach
                                            * {{ $item['quantity'] }} =
                                        </div>
                                        <br>
                                        <strong class="item-subtotal">${{ number_format($item['final_price'] * $item['quantity'], 2) }}</strong>
                                    <td>
                                        <form method="POST" action="{{ route('cart.remove', $index) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-outline-danger btn-cart-delete">
                                                <i class="fa-solid fa-circle-xmark"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="cart__table__footer">
                        <a href="{{ route('shop') }}"><i class="fa-solid fa-left-long"></i> Continue Shopping</a>
                    </div>
                </div>
                <div class="cart__total">
                    <div class="row">
                        <div class="col-12 col-md-8">
                            
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="cart__total__content">
                                <h3>Order Summary</h3>
                                <table>
                                    <tbody>
                                        <tr>
                                            <th>Subtotal</th>
                                            <td id="cart-subtotal">${{ number_format($subtotal, 2) }}</td>
                                        </tr>
                                        <tr>
                                            <th>Tax</th>
                                            <td id="cart-tax">${{ number_format($tax, 2) }}</td>
                                        </tr>
                                        <tr>
                                            <th>Total</th>
                                            <td class="final-price" id="cart-total">${{ number_format($grandTotal, 2) }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <a class="btn btn-theme w-100" href="{{ route('checkout.index') }}">Checkout</a>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
@endsection
@push('css')
<style>
    .quantity-controller {
        width: 70%;
    }
</style>
@endpush
@push('js')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const controllers = document.querySelectorAll('.quantity-controller');

    controllers.forEach(controller => {
        const decrease = controller.querySelector('.-descrease');
        const increase = controller.querySelector('.-increase');
        const numberEl = controller.querySelector('.quantity-controller__number');
        const url = controller.dataset.url;
        const row = controller.closest('tr');

        const updateCart = (newQuantity) => {
            fetch(url, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ quantity: newQuantity })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    numberEl.textContent = newQuantity;
                    // Update subtotal for this item
                    row.querySelector('.item-subtotal').textContent = `$${data.subtotal}`;
                    // Update cart totals
                    document.getElementById('cart-total').textContent = `$${data.cart_total}`;
                    if (data.cart_subtotal) {
                        document.getElementById('cart-subtotal').textContent = `$${data.cart_subtotal}`;
                    }
                    if (data.cart_tax) {
                        document.getElementById('cart-tax').textContent = `$${data.cart_tax}`;
                    }
                } else if (data.error) {
                    alert(data.error);
                }
            })
            .catch(err => console.error('Cart update failed:', err));
        };

        decrease.addEventListener('click', () => {
            let quantity = parseInt(numberEl.textContent);
            if (quantity > 1) {
                quantity--;
                numberEl.textContent = quantity;
                updateCart(quantity);
            }
        });

        increase.addEventListener('click', () => {
            let quantity = parseInt(numberEl.textContent);
            quantity++;
            numberEl.textContent = quantity;
            updateCart(quantity);
        });
    });
});

</script>
@endpush