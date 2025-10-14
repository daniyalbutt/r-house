<div class="right-bar">
    <div id="sidebarRight">
        <div class="right-bar-inner">

            <div class="text-end position-relative">
                <a href="#"
                    class="d-inline-block d-xl-none btn right-bar-btn waves-effect waves-circle btn btn-circle btn-danger btn-sm">
                    <i class="mdi mdi-close"></i>
                </a>
            </div>
            <div class="right-bar-content">
                @if (View::hasSection('sidebar_content'))
                    @yield('sidebar_content')
                @else
                    <div class="box no-shadow box-bordered border-light">
                        <div class="box-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h5>Total Sale</h5>
                                    <h2 class="mb-0">${{ number_format($total_amount, 2) }}</h2>
                                </div>
                                <div class="p-10">
                                    <!-- <div id="chart-spark1"></div> -->
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <div class="d-flex align-items-center justify-content-between">
                                <h5 class="my-0">{{ $total_order }} total orders</h5>
                                <a href="{{ route('order.index') }}" class="mb-0">View Orders</a>
                            </div>
                        </div>
                    </div>
                    <div class="box no-shadow box-bordered border-light">
                        <div class="box-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h5>Total Orders</h5>
                                    <h2 class="mb-0">{{ $total_order }}</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box no-shadow box-bordered border-light">
                        <div class="box-header">
                            <h4 class="box-title">Stock Less Than 10</h4>
                        </div>
                        <div class="box-body p-5">
                            <div class="media-list media-list-hover">
                                @foreach($low_stock as $key => $value)
                                <a class="media media-single mb-10 p-0 rounded-0" href="#">
                                    <h4 class="w-50 text-gray font-weight-500">{{ str_pad($value->stock, 2, '0', STR_PAD_LEFT) }}</h4>
                                    <div class="media-body pl-15 bl-5 rounded border-primary">
                                        <p style="color: black;">{{ $value->name }}</p>
                                        <span class="text-fade">{{ $value->category_name }}</span>
                                    </div>
                                </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
