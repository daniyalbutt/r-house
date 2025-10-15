@extends('layouts.app')

@section('content')
<section class="inner-banner about-banner">
    <div class="breadcrumb">
        <h6>We appreciate your trust</h6>
        <h2>Thank You!</h2>
    </div>
</section>

<section class="thankyou-section">
    <div class="container text-center">
        <div class="thankyou-card">
            <h3 class="mb-3">Thank you for your purchase!</h3>
            @if($order)
                <p class="mb-4">
                    Your order <strong>#{{ $order->invoice ?? $order->id }}</strong> has been successfully placed.
                </p>
            @else
                <p class="mb-4">
                    Thank you for your purchase! Your order has been successfully placed.  
                    If you created an account, you can track it in your dashboard.
                </p>
            @endif

            <div class="d-flex justify-content-center gap-3 flex-wrap" style="gap: 10px;">
                <a href="{{ route('shop') }}" class="btn btn-theme">Continue Shopping</a>

                @auth
                    <a href="{{ route('user.orders') }}" class="btn btn-outline-dark btn-black">View My Orders</a>
                @else
                    
                @endauth
            </div>
        </div>
    </div>
</section>
@endsection

@push('css')
<style>
    .thankyou-section {
        margin-bottom: 100px;
    }
    .thankyou-card {
        background: #fff;
        padding: 40px;
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        max-width: 600px;
        margin: 0 auto;
    }
</style>
@endpush
