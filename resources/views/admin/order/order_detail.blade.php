@extends('admin.layouts.app')
@section('title', 'Orders Detail')
@section('content')
    <div class="container-full">
        <div class="content-header">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="page-title">Order Detail</h3>
                    <div class="d-inline-block align-items-center">
                        <nav>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="#"><i class="mdi mdi-home-outline">Order Management</i></a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Order Detail</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <section class="content">
            <div class="box">
                <div class="box-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="d-flex justify-content-between">
                                <h4 class="box-title">Order Info</h4>
                            </div>
                            <div class="">
                                <table class="table product-table">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Product</th>
                                            <th>Variation</th>
                                            <th>QTY</th>
                                            <th>Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data->products as $key => $items)
                                            @php
                                                $attributes = json_decode($items->pivot->attributes, true);
                                            @endphp
                                            <tr>
                                                <td>{{ ++$key }}</td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <img src="{{ asset($items->image) }}" class="img-fluid me-2" alt="" style="width: 60px; height: auto;">
                                                        <div>
                                                            <span class="fw-bold ml-3">{{ $items->name }}</span><br>
                                                            <span class="fw-bold ml-3">{{ $items->category->name }}</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="variation-box">
                                                    @if(!empty($attributes))
                                                        @foreach($attributes as $key => $attr)
                                                            <p>{{ ucfirst($attr['name']) }}: {{ $attr['value'] }} 
                                                            ( +${{ number_format($attr['addon'], 2) }} )</p>
                                                        @endforeach
                                                    @endif
                                                    </div>
                                                </td>
                                                <td>{{ $items->pivot->quantity }}</td>
                                                <td>
                                                    ${{ $items->pivot->base_price }} + ${{ $items->pivot->variation_price }}<br>
                                                    = ${{ number_format($items->pivot->price, 2) }}
                                                </td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td colspan="4" class="text-right total-price"><b>Total Price:</b></td>
                                            <td class="total-price"><b>${{ number_format($data->amount, 2) }}</b></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box">
                <div class="box-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <h4 class="box-title mt-40">Shipping Address</h4>
                            <div class="table-responsive">
                                <table class="table shipping-table">
                                    <tbody>
                                        <tr>
                                            <td>Invoice ID</td>
                                            <td>{{ $data->invoice }}</td>
                                        </tr>
                                        <tr>
                                            <td>Name</td>
                                            <td>{{ $data->name }}</td>
                                        </tr>
                                        <tr>
                                            <td>Email</td>
                                            <td>{{ $data->email }}</td>
                                        </tr>
                                        <tr>
                                            <td>Phone</td>
                                            <td>{{ $data->phone }}</td>
                                        </tr>
                                        <tr>
                                            <td>Country</td>
                                            <td>{{ ucwords($data->country) }}</td>
                                        </tr>
                                        <tr>
                                            <td>Address</td>
                                            <td>{{ $data->address }}</td>
                                        </tr>
                                        <tr>
                                            <td>ZIP</td>
                                            <td>{{ $data->zip }}</td>
                                        </tr>
                                        <tr>
                                            <td>Payment Token</td>
                                            <td>{{ $data->payment_token }}</td>
                                        </tr>
                                        @if($data->notes != null)
                                        <tr>
                                            <td>Notes</td>
                                            <td>{{ $data->notes }}</td>
                                        </tr>
                                        @endif
                                        <tr>
                                            <td>Payment Method</td>
                                            <td>{{ $data->payment_method }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('css')
    <style>
        td.product-image {
            width: 100px;
            height: 100px;
        }

        td.product-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .change-status {
            background: #014ca9;
            color: white;
        }

        .change-status:hover {
            color: white;
        }

        .success-status {
            background-color: #28a745;
            color: white;
        }

        .success-status:hover {
            color: white;
        }
    </style>
@endpush

@push('js')
@endpush
