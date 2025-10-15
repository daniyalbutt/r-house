@extends('layouts.app')
@section('content')
<section class="inner-banner about-banner">
    <div class="breadcrumb">
        <h6>Order</h6>
        <h2>History</h2>
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
                                @if ($order->isEmpty())
                                <div class="col-12 text-center">
                                    <div class="empty-wishlist">
                                        <i class="fa-solid fa-cart-shopping"></i>
                                        <h5>Your order history is empty</h5>
                                        <p>You haven’t placed any orders yet — start shopping to fill it up!</p>
                                        <a href="{{ route('shop') }}" class="btn btn-theme mt-3">Continue Shopping</a>
                                    </div>
                                </div>
                                @else
                                <div class="tab-content" id="myaccountContent">
                                    <!-- Single Tab Content Start -->
                                    <div class="tab-pane fade show active" id="dashboad">
                                        <div class="myaccount-content">
                                            <div class="section-heading">
                                                <table class="table table-hover align-middle shadow-sm border rounded-3">
                                                    <thead class="bg-light text-uppercase">
                                                        <tr class="text-secondary">
                                                            <th scope="col" style="width: 5%">#</th>
                                                            <th scope="col">Invoice Number</th>
                                                            <th scope="col">Total</th>
                                                            <th scope="col" class="text-center">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @forelse ($order as $key => $items)
                                                            <tr>
                                                                <td>{{ $key + 1 }}</td>
                                                                <td>
                                                                    <span class="fw-semibold text-dark">{{ $items->invoice }}</span>
                                                                </td>
                                                                <td>
                                                                    <span class="fw-bold text-success">${{ number_format($items->amount, 2) }}</span>
                                                                </td>
                                                                <td class="text-center">
                                                                    <a href="{{ route('user.generateinvoice', $items->id) }}" 
                                                                    class="btn btn-theme">View</a>
                                                                </td>
                                                            </tr>
                                                        @empty
                                                            <tr>
                                                                <td colspan="4" class="text-center text-muted py-4">
                                                                    <i class="fa fa-info-circle me-2"></i> No orders found.
                                                                </td>
                                                            </tr>
                                                        @endforelse
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                @endif
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
<style>
    .btn-theme {
        padding: 0px 15px;
        font-size: 18px;
    }
    
    .table {
        border-radius: 10px;
        overflow: hidden;
        font-size: 15px;
    }

    .table thead {
        background-color: #f8f9fa;
    }

    .table th {
        font-weight: 600;
        letter-spacing: 0.5px;
    }

    .table-hover tbody tr:hover {
        background-color: #f1f5ff;
        transition: 0.3s;
    }

    .view-invoice {
        font-size: 0.9rem;
    }
</style>
@endpush