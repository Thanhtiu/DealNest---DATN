@extends('layouts.client.app')
@section('content')
<!-- Bootstrap CSS and Icons -->

<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css" rel="stylesheet">
<style>
    /* Tabs Styling */
    .tabs-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 20px 0;
        border-bottom: 1px solid #e1e1e1;
        margin-bottom: 20px;
    }

    .tabs-container .tabs {
        display: flex;
        justify-content: flex-start;
        width: 100%;
    }

    .tabs-container .tabs a {
        color: #333;
        text-decoration: none;
        margin-right: 30px;
        border-bottom: 2px solid transparent;
        cursor: pointer;
    }

    .tabs-container .tabs a.active {
        color: #f53d2d;
        border-bottom: 2px solid #f53d2d;
    }

    /* Search Bar */
    .search-bar {
        display: flex;
        align-items: center;
        margin: 15px 0;
    }

    .search-bar input {
        padding: 8px 15px;
        width: 100%;
        max-width: 600px;
        border: 1px solid #e1e1e1;
        border-radius: 4px;
    }

    .search-bar button {
        background-color: #0d6efd;
        color: #fff;
        padding: 8px 20px;
        border: none;
        margin-left: 10px;
        border-radius: 4px;
        cursor: pointer;
    }

    .search-bar button:hover {
        background-color: #e03a26;
    }

    /* Order Section */
    .order-container {
        background-color: #fff;
        border: 1px solid #e1e1e1;
        padding: 15px;
        margin-bottom: 20px;
        border-radius: 4px;
    }

    .order-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 1px solid #e1e1e1;
        padding-bottom: 10px;
        margin-bottom: 10px;
    }

    .order-header-left {
        font-weight: bold;
        color: #f53d2d;
    }

    .order-header-right {
        color: #9e9e9e;
    }

    /* Separator between order items */
    .order-item-separator {
        border-bottom: 1px solid #e1e1e1;
        margin: 20px 0;
    }

    .order-item {
        display: flex;
        justify-content: space-between;
        margin-bottom: 10px;
    }

    .order-item-info {
        display: flex;
        align-items: center;
    }

    .order-item-image {
        width: 81px;
        height: 81px;
        margin-right: 15px;
    }

    .order-item-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .order-item-details {
        color: #333;
    }

    .order-item-price {
        color: #f53d2d;
        font-weight: bold;
    }

    /* Updated Order Actions */
    .order-actions {
        display: flex;
        justify-content: flex-end;
        /* Align both buttons to the right */
        align-items: center;
        margin-top: 15px;
    }

    .order-actions button {
        background-color: #0d6efd;
        color: #fff;
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        margin-left: 10px;
        /* Add space between the buttons */
    }

    .order-actions button:hover {
        background-color: #e03a26;
    }

    .order-actions .secondary-button {
        background-color: #f1f1f1;
        color: #333;
        border: 1px solid #e1e1e1;
    }

    .order-actions .secondary-button:hover {
        background-color: #ddd;
    }

    .tabs-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 20px 0;
        border-bottom: 1px solid #e1e1e1;
        margin-bottom: 20px;
    }

    .tabs-container .tabs {
        display: flex;
        justify-content: flex-start;
        width: 100%;
    }

    .tabs-container .tabs a {
        color: #333;
        text-decoration: none;
        margin-right: 30px;
        border-bottom: 2px solid transparent;
        cursor: pointer;
    }



    /* Search Bar */
    .search-bar {
        display: flex;
        align-items: center;
        margin: 15px 0;
    }

    .search-bar input {
        padding: 8px 15px;
        width: 100%;
        max-width: 600px;
        border: 1px solid #e1e1e1;
        border-radius: 4px;
    }

    .search-bar button {
        background-color: #0d6efd;
        color: #fff;
        padding: 8px 20px;
        border: none;
        margin-left: 10px;
        border-radius: 4px;
        cursor: pointer;
    }

    .search-bar button:hover {
        background-color: #337ce8;
    }

    /* Order Section */
    .order-container {
        background-color: #fff;
        border: 1px solid #e1e1e1;
        padding: 15px;
        margin-bottom: 20px;
        border-radius: 4px;
    }

    .order-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 1px solid #e1e1e1;
        padding-bottom: 10px;
        margin-bottom: 10px;
    }

    .order-header-left {
        font-weight: bold;
        color: #f53d2d;
    }

    .order-header-right {
        color: #9e9e9e;
        display: flex;
        align-items: center;
    }

    .order-header-right i {
        margin-right: 5px;
        color: green;
    }

    /* Updated Order Actions */
    .order-actions {
        display: flex;
        justify-content: flex-end;
        /* Align both buttons to the right */
        align-items: center;
        margin-top: 15px;
    }

    .order-actions button {
        background-color: #0d6efd;
        color: #fff;
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        margin-left: 10px;
        /* Add space between the buttons */
    }

    .order-actions button:hover {
        background-color: #337ce8;
    }

    .order-actions .secondary-button {
        background-color: #f1f1f1;
        color: #333;
        border: 1px solid #e1e1e1;
    }

    .order-actions .secondary-button:hover {
        background-color: #ddd;
    }

    /* Separator between order items */
    .order-item-separator {
        border-bottom: 1px solid #e1e1e1;
        margin: 20px 0;
    }

    /* Ẩn tất cả các tab content theo mặc định */
    .tab-content {
        display: none;
    }

    /* Chỉ hiển thị tab content có lớp 'active' */
    .tab-content.active {
        display: block;
    }

    /* Thiết lập tab đang hoạt động */
</style>

<section class="py-5">
    <div class="container">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3">
                @include('layouts.client.sidebar')
            </div>

            <!-- Order Content -->
            <div class="col-md-9">
                <!-- Order Section -->
                <div class="order-container">
                    <!-- Tabs and Search Bar -->
                    <div class="tabs-container">
                        <div class="tabs">
                            <a href="#" class="active">Tất cả</a>
                            <a href="#">Chờ xác nhận</a>
                            <a href="#">Chờ giao hàng</a>
                            <a href="#">Hoàn thành</a>
                            <a href="#">Đã hủy</a>
                            <a href="#">Trả hàng/Hoàn tiền</a>
                        </div>
                    </div>


                    <!-- Search Bar -->
                    <div class="search-bar">
                        <input type="text" placeholder="Bạn có thể tìm kiếm theo tên Shop, ID đơn hàng hoặc Tên Sản phẩm">
                        <button type="submit">Tìm kiếm</button>
                    </div>

                    <div class="order-header">
                        <div class="order-header-left">
                        </div>

                    </div>

                    <div class="tab-content active" id="1">
                        @if($orderAll->isEmpty())
                        <div class="text-center">
                            <img class="wishlist-data-image" src="{{ asset('image/no-data.png') }}" alt="No Data" style="width: 200px;">
                            <p class="text-center mt-3">Không có đơn hàng nào chờ xác nhận </p>
                        </div>
                        @else
                        @foreach($orderAll as $order)
                        @foreach($order->orderItems as $item)
                        <div class="order-item">
                            <div class="order-item-info">
                                <div class="order-item-image">
                                    <img src="{{ asset('uploads/' . $item->product->image) }}" alt="Product Image">
                                </div>
                                <div class="order-item-details">
                                    <p>{{ $item->product->name }}</p>
                                    <p>Phân loại hàng: Màu đen mặc định, Balo + Gấu cam</p>
                                </div>
                            </div>
                            <div class="order-item-price">
                                <p>₫{{ number_format($item->price, 0, ',', '.') }}</p>
                                <p>Trạng thái:
                                        @switch($item->status)
                                        @case('pending')
                                        <span>Hủy đơn hàng</span>
                                        @break

                                        @case('waiting_for_delivery')
                                        <span>Đang chờ giao hàng</span>
                                        @break

                                        @case('success')
                                        <span>Đơn hàng thành công</span>
                                        @break

                                        @case('return')
                                        <span>Đơn hàng đã trả lại</span>
                                        @break

                                        @case('refund')
                                        <span>Đơn hàng đã hoàn tiền</span>
                                        @break

                                        @default
                                        <span>Trạng thái không xác định</span>
                                        @endswitch
                                    </p>
                            </div>
                        </div>
                        <div class="order-actions">
                            <button class="secondary-button">Liên hệ người bán</button>
                            @switch($item->status)
                            @case('pending')
                            <button>Hủy đơn hàng</button>
                            @break

                            @case('waiting_for_delivery')
                            <button>Mua lại</button>
                            @break

                            @case('success')
                            <button>Mua lại</button>
                            @break

                            @case('return')
                            <button>Mua lại</button>
                            @break

                            @endswitch
                        </div>

                        <!-- Separator between products -->
                        <div class="order-item-separator"></div>
                        @endforeach

                        <hr> <!-- Dòng ngăn cách giữa các đơn hàng -->
                        @endforeach
                        @endif

                    </div>

                    <div id="tab-2" class="tab-content">
                        @if($orderPending->isEmpty())
                        <div class="text-center">
                            <img class="wishlist-data-image" src="{{ asset('image/no-data.png') }}" alt="No Data" style="width: 200px;">
                            <p class="text-center mt-3">Không có đơn hàng nào chờ xác nhận </p>
                        </div>
                        @else
                        @foreach($orderPending as $order)
                        @foreach($order->orderItems as $item)
                        <div class="order-item">
                            <div class="order-item-info">
                                <div class="order-item-image">
                                    <img src="{{ asset('uploads/' . $item->product->image) }}" alt="Product Image">
                                </div>
                                <div class="order-item-details">
                                    <p>{{ $item->product->name }}</p>
                                    <p>Phân loại hàng: Màu đen mặc định, Balo + Gấu cam</p>
                                </div>
                            </div>
                            <div class="order-item-price">
                                <p>₫{{ number_format($item->price, 0, ',', '.') }}</p>
                               
                            </div>
                        </div>
                        <div class="order-actions">
                            <button class="secondary-button">Liên hệ người bán</button>
                            <button>Hủy đơn hàng</button>
                        </div>

                        <!-- Separator between products -->
                        <div class="order-item-separator"></div>
                        @endforeach

                        <hr> <!-- Dòng ngăn cách giữa các đơn hàng -->
                        @endforeach
                        @endif
                    </div>

                    <div id="tab-4" class="tab-content">
                        <p>Tab nội dung Chờ giao hàng</p>
                    </div>

                    <div id="tab-5" class="tab-content">
                        <p>Tab nội dung Hoàn thành</p>
                    </div>

                    <div id="tab-6" class="tab-content">
                        <p>Tab nội dung Đã hủy</p>
                    </div>

                    <div id="tab-7" class="tab-content">
                        <p>Tab nội dung Trả hàng/Hoàn tiền</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="{{asset('client/js/tabindex.js')}}"></script>
@endsection