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
        align-items: center;
        margin-bottom: 15px;
        /* Tăng khoảng cách giữa các mục */
        padding: 10px;
        background-color: #f9f9f9;
        border-radius: 8px;
        border: 1px solid #e1e1e1;
    }

    .order-item-info {
        display: flex;
        align-items: center;
        max-width: 60%;
        /* Đảm bảo hình ảnh và thông tin không bị quá rộng */
    }

    .order-item-image img {
        border-radius: 8px;
        /* Tạo viền bo tròn cho hình ảnh */
    }

    .order-item-details p {
        margin: 0;
        padding: 5px 0;
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

    /* Order Item Image */
    .order-item-image {
        width: 100px;
        height: 100px;
        margin-right: 15px;
        overflow: hidden;
    }

    .order-item-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        /* Đảm bảo hình ảnh không bị méo */
        border-radius: 8px;
        /* Tạo viền bo tròn cho hình ảnh */
    }

    /* Updated Order Actions */
    .order-actions {
        display: flex;
        justify-content: flex-end;
        align-items: center;
        margin-top: 10px;
    }

    .order-actions button {
        background-color: #0d6efd;
        color: #fff;
        padding: 5px 10px;
        /* Giảm padding để nút nhỏ hơn */
        font-size: 14px;
        /* Giảm kích thước chữ */
        border: none;
        border-radius: 4px;
        cursor: pointer;
        margin-left: 8px;
        /* Khoảng cách giữa các nút */
        min-width: 80px;
        /* Đặt chiều rộng tối thiểu để đảm bảo nút không quá nhỏ */
    }

    .order-actions button:hover {
        background-color: #337ce8;
    }

    .order-actions .secondary-button {
        background-color: #f1f1f1;
        color: #333;
        padding: 5px 10px;
        /* Giảm padding để nút nhỏ hơn */
        font-size: 14px;
        /* Giảm kích thước chữ */
        border: 1px solid #e1e1e1;
        min-width: 80px;
        /* Đặt chiều rộng tối thiểu cho nút "Liên hệ người bán" */
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
                            <a href="#" class="">Tất cả</a>
                            <a href="#">Chờ xác nhận</a>
                            <a href="#">Chờ giao hàng</a>
                            <a href="#">Hoàn thành</a>
                            <a href="#">Đã từ chối</a>
                            <a href="#">Đã hủy</a>

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
                                    <p>Phân loại hàng: {{$item->attribute}}</p>
                                    @if($item->status === 'cancel')
                                    <p>Lí do từ chối: <span style="color: red;">{{$item->cancellation_reason}}</span></p>
                                    @endif
                                </div>
                            </div>
                            <div class="order-item-price">
                                <p>₫{{ number_format($item->price, 0, ',', '.') }}</p>
                                <p>Trạng thái:
                                    @switch($item->status)
                                    @case('pending')
                                    <span>Chờ duyệt</span>
                                    @break

                                    @case('waiting_for_delivery')
                                    <span>Đang giao hàng</span>
                                    @break

                                    @case('success')
                                    <span>Đơn hàng thành công</span>
                                    @break

                                    @case('cancel')
                                    <span>Đơn hàng bị từ chối</span>
                                    @break

                                    @default
                                    <span>Đơn hàng đã hủy</span>
                                    @endswitch
                                </p>
                            </div>
                        </div>
                        <div class="order-actions">
                            <button class="secondary-button">Liên hệ người bán</button>
                            @switch($item->status)
                            @case('pending')
                            <button class="cancel-order-item" data-order-item-id="{{ $item->id }}" data-status="buyer_cancel">Hủy đơn hàng</button>
                            @break

                            @case('success')
                            <button>Mua lại</button>
                            @break

                            @case('cancel')
                            @break

                            @case('buyer_cancel')
                            <button>Mua lại</button>

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
                        @foreach($orderPending as $order)
                        @if($order->pendingOrderItems->isEmpty())
                        <div class="text-center">
                            <img class="wishlist-data-image" src="{{ asset('image/no-data.png') }}" alt="No Data" style="width: 200px;">
                            <p class="text-center mt-3">Không có đơn hàng nào chờ xác nhận</p>
                        </div>
                        @else
                        @foreach($order->pendingOrderItems as $item)
                        <div class="order-item" id="order-item-{{ $item->id }}">
                            <div class="order-item-info">
                                <div class="order-item-image">
                                    <img src="{{ asset('uploads/' . $item->product->image) }}" alt="Product Image">
                                </div>
                                <div class="order-item-details">
                                    <p>{{ $item->product->name }}</p>
                                    <p>Phân loại hàng: {{$item->attribute}}</p>
                                </div>
                            </div>
                            <div class="order-item-price">
                                <p>₫{{ number_format($item->price, 0, ',', '.') }}</p>
                            </div>
                            <div class="order-actions">
                                <button class="secondary-button">Liên hệ người bán</button>
                                @switch($item->status)
                                @case('pending')
                                <button class="cancel-order-item" data-order-item-id="{{ $item->id }}" data-status="buyer_cancel">Hủy đơn hàng</button>
                                @break
                                @case('success')
                                <button>Mua lại</button>
                                @break
                                @case('cancel')
                                <button>Mua lại</button>
                                @break
                                @default
                                <span>Không rõ trạng thái</span>
                                @endswitch
                            </div>
                        </div>

                        <!-- Separator between products -->
                        <div class="order-item-separator"></div>
                        @endforeach
                        @endif
                        <hr> <!-- Dòng ngăn cách giữa các đơn hàng -->
                        @endforeach
                    </div>


                    <div id="tab-4" class="tab-content">
                        @foreach($orderWaitingForDelivery as $order)
                        @if($order->waitingForDeliveryOrderItems->isEmpty())
                        <div class="text-center">
                            <img class="wishlist-data-image" src="{{ asset('image/no-data.png') }}" alt="No Data" style="width: 200px;">
                            <p class="text-center mt-3">Không có đơn hàng nào đang giao</p>
                        </div>
                        @else
                        @foreach($order->waitingForDeliveryOrderItems as $item)
                        <div class="order-item" id="order-item-{{ $item->id }}">
                            <div class="order-item-info">
                                <div class="order-item-image">
                                    <img src="{{ asset('uploads/' . $item->product->image) }}" alt="Product Image">
                                </div>
                                <div class="order-item-details">
                                    <p>{{ $item->product->name }}</p>
                                    <p>Phân loại hàng: {{$item->attribute}}</p>
                                </div>
                            </div>
                            <div class="order-item-price">
                                <p>₫{{ number_format($item->price, 0, ',', '.') }}</p>
                            </div>
                            <div class="order-actions">
                                <button class="secondary-button">Liên hệ người bán</button>
                                <button class="cancel-order-item" data-order-item-id="{{ $item->id }}" data-status="success">Đã nhận</button>

                            </div>
                        </div>

                        <!-- Separator between products -->
                        <div class="order-item-separator"></div>
                        @endforeach
                        @endif
                        <hr> <!-- Dòng ngăn cách giữa các đơn hàng -->
                        @endforeach

                    </div>

                    <div id="tab-5" class="tab-content">
                        @foreach($orderSuccess as $order)
                        @if($order->successOrderItems->isEmpty())
                        <div class="text-center">
                            <img class="wishlist-data-image" src="{{ asset('image/no-data.png') }}" alt="No Data" style="width: 200px;">
                            <p class="text-center mt-3">Không có đơn hàng nào giao thành công</p>
                        </div>
                        @else
                        @foreach($order->successOrderItems as $item)
                        <div class="order-item" id="order-item-{{ $item->id }}">
                            <div class="order-item-info">
                                <div class="order-item-image">
                                    <img src="{{ asset('uploads/' . $item->product->image) }}" alt="Product Image">
                                </div>
                                <div class="order-item-details">
                                    <p>{{ $item->product->name }}</p>
                                    <p>Phân loại hàng: {{$item->attribute}}</p>
                                </div>
                            </div>
                            <div class="order-item-price">
                                <p>₫{{ number_format($item->price, 0, ',', '.') }}</p>
                            </div>
                            <div class="order-actions">
                                <button class="secondary-button">Liên hệ người bán</button>
                                <button>Mua lại</button>
                            </div>
                        </div>

                        <!-- Separator between products -->
                        <div class="order-item-separator"></div>
                        @endforeach
                        @endif
                        <hr> <!-- Dòng ngăn cách giữa các đơn hàng -->
                        @endforeach
                    </div>

                    <div id="tab-6" class="tab-content">
                        @foreach($orderCancel as $order)
                        @if($order->cancelOrderItems->isEmpty())
                        <div class="text-center">
                            <img class="wishlist-data-image" src="{{ asset('image/no-data.png') }}" alt="No Data" style="width: 200px;">
                            <p class="text-center mt-3">Không có đơn hàng nào bị từ chối</p>
                        </div>
                        @else
                        @foreach($order->cancelOrderItems as $item)
                        <div class="order-item" id="order-item-{{ $item->id }}">
                            <div class="order-item-info">
                                <div class="order-item-image">
                                    <img src="{{ asset('uploads/' . $item->product->image) }}" alt="Product Image">
                                </div>
                                <div class="order-item-details">
                                    <p>{{ $item->product->name }}</p>
                                    <p>Phân loại hàng: {{$item->attribute}}</p>
                                    <p class="order-item-cancel">Lí do từ chối: <span style="color: red;">{{$item->cancellation_reason}}</span></p>

                                </div>
                            </div>
                            <div class="order-item-price">
                                <p>₫{{ number_format($item->price, 0, ',', '.') }}</p>
                            </div>
                            <div class="order-actions">
                                <button class="secondary-button">Liên hệ người bán</button>
                                <button>Mua lại</button>
                            </div>
                        </div>


                        @endforeach
                        @endif
                        <hr> <!-- Dòng ngăn cách giữa các đơn hàng -->
                        @endforeach
                    </div>

                    <div id="tab-7" class="tab-content">
                        @foreach($orderBuyerCancel as $order)
                        @if($order->buyerCancelOrderItems->isEmpty())
                        <div class="text-center">
                            <img class="wishlist-data-image" src="{{ asset('image/no-data.png') }}" alt="No Data" style="width: 200px;">
                            <p class="text-center mt-3">Không có đơn hàng nào hủy</p>
                        </div>
                        @else
                        @foreach($order->buyerCancelOrderItems as $item)
                        <div class="order-item" id="order-item-{{ $item->id }}">
                            <div class="order-item-info">
                                <div class="order-item-image">
                                    <img src="{{ asset('uploads/' . $item->product->image) }}" alt="Product Image">
                                </div>
                                <div class="order-item-details">
                                    <p>{{ $item->product->name }}</p>
                                    <p>Phân loại hàng: {{$item->attribute}}</p>
                                </div>
                            </div>
                            <div class="order-item-price">
                                <p>₫{{ number_format($item->price, 0, ',', '.') }}</p>
                            </div>
                            <div class="order-actions">
                                <button class="secondary-button">Liên hệ người bán</button>
                                <button>Mua lại</button>
                            </div>
                        </div>

                        <!-- Separator between products -->
                        <div class="order-item-separator"></div>
                        @endforeach
                        @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="{{asset('client/js/tabindex.js')}}"></script>
<script>
    $(document).on('click', '.cancel-order-item', function() {
        var orderItemId = $(this).data('order-item-id');
        var status = $(this).data('status'); // Lấy giá trị trạng thái từ data-status
        var orderItemElement = $(this).closest('.order-item'); // Lấy phần tử chứa thông tin sản phẩm

        console.log(orderItemElement); // Kiểm tra xem phần tử có được chọn đúng không

        $.ajax({
            url: '{{ route("acccount.order.updateStatus") }}',
            type: 'POST',
            data: {
                order_item_id: orderItemId,
                status: status, // Truyền trạng thái động
                _token: '{{ csrf_token() }}' // Đảm bảo bảo vệ CSRF
            },
            success: function(response) {
                if (response.success) {

                    // Ẩn hoặc loại bỏ mục OrderItem khỏi giao diện sau khi cập nhật thành công
                    orderItemElement.fadeOut(500, function() {
                        $(this).remove(); // Xóa phần tử khỏi DOM
                    });
                    toastr.success(response.message);
                } else {
                    alert(response.message);
                }
            },
            error: function(xhr) {
                console.log(xhr.responseText);
                alert('Có lỗi xảy ra khi cập nhật trạng thái đơn hàng.');
            }
        });
    });
</script>
@endsection