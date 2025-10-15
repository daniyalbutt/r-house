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
                                                <table class="table table-bordered table-striped">
                                                    <thead class="thead-light">
                                                        <tr>
                                                            <th>S.No</th>
                                                            <th>Customer Name</th>
                                                            <th>Invoice Number</th>
                                                            <th>Total</th>
                                                            <th>View Invoice</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($order as $key => $items)
                                                            <tr>
                                                                <td>{{ $key + 1 }}</td>
                                                                <td>{{ $items->name }}</td>
                                                                <td>{{ $items->invoice }}</td>
                                                                <td>${{ $items->amount }}</td>
                                                                <td><a href="{{ route('user.generateinvoice', $items->id) }}"
                                                                        class="btn view-invoice" data-toggle="tooltip"
                                                                        data-original-title="Invoice">View</a>
                                                                </td>
                                                            </tr>
                                                        @endforeach
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
